function ajaxRequest(type, url, callback, data = null)
{
  let xhr;

  // Create XML HTTP request.
  xhr = new XMLHttpRequest();

  let path = window.location.href.split('/');
  path.pop();
  path.push('api.php')
  path.push(url);

  xhr.open(type , path.join('/'));
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

  // Add response handler.
  xhr.onload = () =>
  {
    switch (xhr.status)
    {
      case 200:
        let resp = JSON.parse(xhr.responseText);
        callback(resp);
        break;
      case 201:
        // console.log(url);
      default:
        console.error(xhr.status);
    }
  };

  // Send XML HTTP request.
  xhr.send(data);
}