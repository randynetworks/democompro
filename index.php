<?php
date_default_timezone_set('Asia/Jakarta'); // Set time zone to WIB (Western Indonesia Time)
$protocol = isset( $_SERVER['SERVER_PROTOCOL'] ) ? $_SERVER['SERVER_PROTOCOL'] : '';
if ( ! in_array( $protocol, array( 'HTTP/1.1', 'HTTP/2', 'HTTP/2.0' ), true ) ) {
   $protocol = 'HTTP/1.0';
}
header( "$protocol 503 Service Unavailable", true, 503 );
header( 'Content-Type: text/html; charset=utf-8' );
header( 'Retry-After: 30' );
?>

<!doctype html>
<html lang="id">
  <head>
    <title>Pemeliharaan Situs</title>
    <meta charset="utf-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
      body { text-align: center; padding: 20px; font: 20px Helvetica, sans-serif; color: #333; background-color:#FFFFFF}
      @media (min-width: 768px){
        body{ padding-top: 150px; }
      }
      h1 { font-size: 50px; }
      article { display: block; text-align: left; max-width: 650px; margin: 0 auto; }
      a { color: #dc8100; text-decoration: none; }
      a:hover { color: #333; text-decoration: none; }
    </style>
  </head>
  <body>
    <article>
        <h1>Kami Akan Kembali Segera!</h1>
        <div>
            <p>Maaf atas ketidaknyamanannya, kami sedang melakukan pemeliharaan saat ini. Kami akan segera kembali online!</p>
            <p>&mdash; Tim Kami</p>
            
        </div>
        <div style="display: flex; flex-direction: row; justify-content: space-between;">
            <p class="day"></p>
            <p class="hour"></p>
            <p class="minute"></p>
            <p class="second"></p>
        </div>
    </article>
    <script>
        const countDown = () => {
            const countDay = new Date('July 01, 2024 00:00:00 GMT+0700');
            const now = new Date();
            const counter = countDay - now;
            const second = 1000;
            const minute = second * 60;
            const hour = minute * 60;
            const day = hour * 24;
            const textDay = Math.floor(counter / day);
            const textHour = Math.floor((counter % day) / hour);
            const textMinute = Math.floor((counter % hour) / minute);
            const textSecond = Math.floor((counter % minute) / second);
            document.querySelector(".day").innerText = textDay + ' Hari';
            document.querySelector(".hour").innerText = textHour + ' Jam';
            document.querySelector(".minute").innerText = textMinute + ' Menit';
            document.querySelector(".second").innerText = textSecond + ' Detik';
        }
        countDown();
        setInterval(countDown, 1000);
    </script>
  </body>
</html>
