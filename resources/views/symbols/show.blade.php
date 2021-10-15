<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
      <div class="container">
          <div class="row">
              <div class="col">
                  <ul>
                      <li>Avg open: {{ $avgOpen }}</li>
                      <li>Avg close: {{ $avgClose }}</li>
                      <li>Avg high: {{ $avgHigh }}</li>
                      <li>Avg low: {{ $avgLow }}</li>
                  </ul>
                  <ul>
                      <li>Median open: {{ $medianOpen }}</li>
                      <li>Median close: {{ $medianClose }}</li>
                      <li>Median high: {{ $medianHigh }}</li>
                      <li>Median low: {{ $medianLow }}</li>
                  </ul>
                  <ul>
                      <li>Max high: {{ $maxHigh }}</li>
                      <li>Min low: {{ $minLow }}</li>
                  </ul>
              </div>
          </div>
        <table class="table">
            <tr>
                <th>Open time</th>
                <th>Open</th>
                <th>High</th>
                <th>Low</th>
                <th>Close</th>
                <th>Volume</th>
                <th>Close time</th>
            </tr>
            @foreach($data as $key => $item)
            <?php $prevIndex = $key === 0 ? 0 : $key - 1; ?>
            <tr>
                <td>{{ $item->open_time }}</td>
                <td>{{ $item->open }}</td>
                <td class='<?php /*$data[$prevIndex]->high > $item->high ? "table-danger" : "table-success";*/ ?>'>{{ $item->high }}</td>
                <td class='<?php /*$data[$prevIndex]->low > $item->low ? "table-danger" : "table-success";*/ ?>'>{{ $item->low }}</td>
                <td class='<?php /*$data[$prevIndex]->close > $item->close ? "table-danger" : "table-success";*/ ?>'>{{ $item->close }}</td>
                <td>{{ $item->volume }}</td>
                <td>{{ $item->close_time }}</td>
            </tr>
            @endforeach
        </table>
      </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>