<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сервис сокращения ссылок - Simple.link</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="script.js"></script>
</head>
<body>
  <div class="container">
    <div class="section-name">
      <h1>SIMPLE.LINK</h1>
      <h2>Сервис сокращения ссылок</h2>
      <div id="alert" class="alert hidden">
        <strong>Запрос успешно выполнен</strong>
      </div>
    </div>
    <div class="section-form">
      <form id="form">
        <div class="input-group">
          <input type="text" class="input" placeholder="Введите URL-адрес" name='long_url'>
          <button class="btn" type="button" onclick="getShortLink()">Выполнить</button>
        </div>
      </form>
      <div id="result" class="input-group hidden">
        <input id="short_url" type="text" class="input" readonly>
        <button class="btn" type="button" onclick="copyShortLink()">Копировать</button>
      </div>
    </div>
  </div>
</body>
</html>
