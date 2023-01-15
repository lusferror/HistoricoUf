<?php
use GuzzleHttp\Client;
$client = new Client();
$headers = [
  'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJQb3N0dWxhY2lvbmVzSldUU2VydmljZUFjY2Vzc1Rva2VuIiwianRpIjoiMjRhMTE3OGQtNGIxMi00MTNiLTk4MWItOTQ2YmZmYWFmYWVhIiwiaWF0IjoiMS8xMy8yMDIzIDk6Mjc6NDQgQU0iLCJVc2VySWQiOiJJZCIsIkRpc3BsYXlOYW1lIjoiUG9zdHVsYW50ZSAyMDIzMDEiLCJVc2VyTmFtZSI6Imx1aXNhbGZyZWRvcm9ibGVzMDlAZ21haWwuY29tIiwiRW1haWwiOiJsdWlzYWxmcmVkb3JvYmxlczA5QGdtYWlsLmNvbSIsImV4cCI6MTY3MzYxNjc2NCwiaXNzIjoiaHR0cHM6Ly9zb2x1dG9yaWEuY2wvIiwiYXVkIjoiSldUU2VydmljZVBvc3R1bGFudGUifQ.87mN0vbhe1deVqOAtAu9kWD95F8t25vgQeFkNPmZ-e4'
];
$request = new Request('GET', 'http://postulaciones.solutoria.cl/api/indicadores', $headers);
$res = $client->sendAsync($request)->wait();
echo $res->getBody();
?>
<!-- <script>
    const token="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJQb3N0dWxhY2lvbmVzSldUU2VydmljZUFjY2Vzc1Rva2VuIiwianRpIjoiYTVlMjJmZjItOWMyNS00YzcxLTkyNDItNTcxZjJhYmMzYjQ4IiwiaWF0IjoiMS8xMy8yMDIzIDg6NDU6MzcgQU0iLCJVc2VySWQiOiJJZCIsIkRpc3BsYXlOYW1lIjoiUG9zdHVsYW50ZSAyMDIzMDEiLCJVc2VyTmFtZSI6Imx1aXNhbGZyZWRvcm9ibGVzMDlAZ21haWwuY29tIiwiRW1haWwiOiJsdWlzYWxmcmVkb3JvYmxlczA5QGdtYWlsLmNvbSIsImV4cCI6MTY3MzYxNDIzNywiaXNzIjoiaHR0cHM6Ly9zb2x1dG9yaWEuY2wvIiwiYXVkIjoiSldUU2VydmljZVBvc3R1bGFudGUifQ.9BMEL4WBmWstVEMlKhDUr1o2KcpfyoQ290kcjJdUhQg"
    fetch('corsAnywhere http://postulaciones.solutoria.cl/api/indicadores',{
        method:"GET",
        headers:new Headers({
            'Authorization':`Bearer ${token}` ,
            'Content-Type':'application/json',
            'Access-Control-Allow-Origin':'*'
        }),
    }
    )
        .then(response=>response.json())
        .then(data=>console.log(data))
        .catch(error=>console.error(error))
</script> -->