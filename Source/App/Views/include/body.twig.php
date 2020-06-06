<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{BASE_CSS}}">

    {% block head %} {% endblock %}
</head>

<body>
    {% block body %} 
    
    {% endblock %}
    <script src="{{JQUERY}}"></script>
	<script src="{{PLUGIN}}"></script>
	<script src="{{APP}}"></script>
    <script src="{{BASE_JAVASCRIPT}}"></script>
</body>

</html>