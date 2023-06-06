import requests
import psycopg2
from psycopg2.extras import execute_batch, execute_values
import time
import urllib.parse
from yt_dlp  import YoutubeDL

YDL_OPTIONS = {'format': 'bestaudio', 'noplaylist': True, 'quiet': True}

def get_youtube_mp4(search):
    with YoutubeDL(YDL_OPTIONS) as ydl:
        video = ydl.extract_info("ytsearch1:"+search+" -live", download=False)["entries"][0]
        # Multiple formats & quality : we get only the last format having mp4 extension
        url = next(format for format in video["formats"][::-1] if format["ext"] == "mp4")["url"]
        duration = video["duration"]
        return (duration, url)


def get_spotify_authorization():
    url = 'https://accounts.spotify.com/api/token'
    body = {
        'grant_type': 'client_credentials',
        'client_id': '32b2cc3b4c0043958d386e355a9be187',
        'client_secret': '3f2fb417f10942e98f41f9ef1db5443e'}

    token_result = requests.post(url, data=body, headers={"Content-Type": "application/x-www-form-urlencoded"})
    return token_result.json()['access_token']


def get_musicbrainz_artist_type(**kwargs):
    code = 0
    while code != 200:
        if code == 503:  # Rate limit -> sleep 1 second
            time.sleep(1)
        if "mbid" in kwargs:  # Search with musicbrainz id
            request_url = "https://musicbrainz.org/ws/2/artist/" + kwargs["mbid"]
        else:  # Search with artist name
            request_url = "https://musicbrainz.org/ws/2/artist/?limit=1&query=artist:" + urllib.parse.quote(kwargs["name"])
        musicbrainz = requests.get(request_url, headers={"Accept": "application/json"})
        code = musicbrainz.status_code
    result_body = musicbrainz.json()
    if "type" in result_body:
        artist_type = result_body["type"]
    elif "type" in result_body["artists"][0]:
        artist_type = result_body["artists"][0]["type"]
    else:
        artist_type = "Unknown"
    return artist_type


def get_artist(**kwargs):
    # Getting artist listeners and musicbrainz id from last fm API
    if "last_fm_artist" in kwargs:
        artist = kwargs["last_fm_artist"]
    elif "spotify_artist" in kwargs:
        response = requests.get("http://ws.audioscrobbler.com/2.0/?api_key=94148cb82b7b9bb2a3121ce94bc0a5f7&format=json&method=artist.search&limit=1&artist=" + urllib.parse.quote(kwargs["spotify_artist"]["name"]))
        artist = response.json()["results"]["artistmatches"]["artist"][0]
    else:
        response = requests.get("http://ws.audioscrobbler.com/2.0/?api_key=94148cb82b7b9bb2a3121ce94bc0a5f7&format=json&method=artist.search&limit=1&artist=" + urllib.parse.quote(kwargs["name"]))
        artist = response.json()["results"]["artistmatches"]["artist"][0]


    # Getting artist type from MusicBrainz API
    if artist["mbid"] == "":  # Unknown musicbrainz id -> search with artist name
        artist_type = get_musicbrainz_artist_type(name=artist["name"])
    else:  # Search with musicbrainz id
        artist_type = get_musicbrainz_artist_type(mbid=artist["mbid"])

    # Getting artist profile image url from spotify
    if "spotify_artist" in kwargs:
        spotify_artist_response = requests.get("https://api.spotify.com/v1/artists/" + kwargs["spotify_artist"]["id"], headers={"Authorization": "Bearer " + token})
        spotify_artist = spotify_artist_response.json()
    else:
        spotify_artist_response = requests.get("https://api.spotify.com/v1/search?q=" + artist["name"] + "&type=artist&limit=1", headers={"Authorization": "Bearer " + token})
        spotify_artist = spotify_artist_response.json()["artists"]["items"][0]

    if len(spotify_artist["images"]) > 0:
        profile_image = spotify_artist["images"][0]["url"]
    else :
        profile_image = "localhost/Ressources/default.png"

    db_data_tuple = (spotify_artist["name"], artist["listeners"], profile_image, artist_type)
    return db_data_tuple, spotify_artist["id"], spotify_artist["genres"]


def verify_artist_already_fetched(name, artists_insert_values):
    for artist in artists_insert_values:
        artist_name = artist[0]
        if name.upper() == artist_name.upper():
            return True
    return False


# Getting Top Artists from Last FM API
response = requests.get("http://ws.audioscrobbler.com/2.0/?api_key=94148cb82b7b9bb2a3121ce94bc0a5f7&format=json&method=chart.gettopartists&limit=20")
artists_list = response.json()["artists"]["artist"]

# Getting Authorization Token from Spotify API
token = get_spotify_authorization()

# PSQL Insert dataz lists
artists_insert_values = []
albums_insert_values = []
albums_composed_by = []
songs_insert_values = []
songs_created_by = []
genres_insert_values = []
album_genre_association_list = []

# Database id of inserted elements
artist_id = 1
album_id = 1
song_id = 1

for artist in artists_list:

    try:
        artist_data, spotify_artist_id, genres = get_artist(last_fm_artist=artist)

        if not verify_artist_already_fetched(artist['name'], artists_insert_values):
            artists_insert_values.append(artist_data)
            print(artist_data[0])

        for genre in genres:
            if not (genre,) in genres_insert_values:
                genres_insert_values.append((genre,))

        spotify_albums_response = requests.get("https://api.spotify.com/v1/artists/" + spotify_artist_id + "/albums?include_groups=album&limit=5", headers={"Authorization": "Bearer " + token})
        artist_albums_list = spotify_albums_response.json()["items"]

        for album in artist_albums_list:
            if not ("remix" in album["name"].lower() or "edition" in album["name"].lower() or "deluxe" in album["name"].lower() or "live" in album["name"].lower()):
                print("     " + album["name"])

                cover = album["images"][0]["url"]

                if album["release_date_precision"] == "year":
                    release_date = album["release_date"] + "-01-01"
                elif album["release_date_precision"] == "month":
                    release_date = album["release_date"] + "-01"
                else:
                    release_date = album["release_date"]

                albums_insert_values.append((album["name"], release_date, cover))

                for genre in genres:
                    album_genre_association_list.append((genre, album_id))

                for composer in album["artists"]:
                    albums_composed_by.append((album_id, composer["name"]))
                    if not verify_artist_already_fetched(composer["name"], artists_insert_values):
                        artist_data = get_artist(spotify_artist=composer)
                        artists_insert_values.append(artist_data[0])
                        print(artist_data[0][0])

                spotify_songs_response = requests.get("https://api.spotify.com/v1/albums/" + album["id"] + "/tracks", headers={"Authorization": "Bearer " + token})
                album_songs_list = spotify_songs_response.json()["items"]

                for song in album_songs_list:
                    print("          " + song["name"])

                    try:
                        (duration, url) = get_youtube_mp4(song["name"] + " " + artist["name"])
                    except:
                        (duration, url) = (0, "undefined")


                    songs_insert_values.append((song["name"], duration, url, album_id))

                    for creator in song["artists"]:
                        songs_created_by.append((song_id, creator["name"]))
                        if not verify_artist_already_fetched(creator["name"], artists_insert_values):
                            artist_data = get_artist(spotify_artist=creator)
                            artists_insert_values.append(artist_data[0])
                            print(artist_data[0][0])

                    song_id = song_id + 1
                album_id = album_id + 1
    except:
        pass            

# Starting PostgreSQL connexion
conn = psycopg2.connect("host='localhost' dbname='dev_db' user='web_project' password='IsenCIR2'")
conn.set_client_encoding('UTF8')

cur = conn.cursor()

# Inserting musicbrainz artist type to database
cur.execute("INSERT INTO type_artiste(type) VALUES ('Person'), ('Group'), ('Choir'), ('Orchestra'), ('Character'), ('Other'), ('Unknown')")

# Inserting all artists
cur.execute("PREPARE stmt AS INSERT INTO artiste (nom, nb_auditeurs, image, id_type_artiste) VALUES($1, $2, $3, (SELECT id FROM type_artiste WHERE type = $4))")
execute_batch(cur, "EXECUTE stmt (%s, %s, %s, %s)", artists_insert_values)
cur.execute("DEALLOCATE stmt")

# Inserting all albums
execute_values(cur, "INSERT INTO album (titre, date_parution, image) VALUES %s", albums_insert_values)

# Linking albums to artists
cur.executemany("INSERT INTO a_compose (id, id_artiste) VALUES(%s, (SELECT id FROM artiste WHERE nom = %s))", albums_composed_by)

# Inserting all tracks
execute_values(cur, "INSERT INTO morceau (titre, duree, data, id_album) VALUES %s", songs_insert_values)

# Linking tracks to artists
cur.executemany("INSERT INTO cree_par (id_morceau, id) VALUES(%s, (SELECT id FROM artiste WHERE nom = %s))", songs_created_by)

# Inserting music genres
execute_values(cur, "INSERT INTO style_musique (type_musique) VALUES %s", genres_insert_values)

# Linking album to genre
cur.execute("PREPARE stmt AS INSERT INTO appartient_a VALUES ((SELECT id FROM style_musique WHERE type_musique = $1), $2)")
execute_batch(cur, "EXECUTE stmt (%s, %s)", album_genre_association_list)
cur.execute("DEALLOCATE stmt")

# End transaction
conn.commit()

cur.close()
conn.close()