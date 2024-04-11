<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Notificación Alisfoods HelpDesk</title>
    <style>
        .enlace {
            color: #2d63c8;
            background-color: #ffffff;
            font-size: 19px;
            border: 1px solid #2d63c8;
            padding: 15px 50px;
            cursor: pointer
        }
    </style>
</head>

<body style="padding:20px;background-color:#D0D3D4;">
    <div style="background-color:white;padding:20px;">
        <center>
            <img style="width:60%"
                src="https://media.licdn.com/dms/image/D4D05AQGE4j7GcLe4lw/feedshare-thumbnail_720_1280/0/1701812571000?e=2147483647&v=beta&t=LRyJzIE9NS4m1NCQIEbmkO5fXiWXRaOZFHN3iS68iaA">
        </center>
        <br>
        <center>
            <h1 style="color: #3498DB">Mesa de ayuda<br>"AlisFoods"</h1>
        </center>
        <p style="font-size: 22px;">
            @if ($tipo_notificacion == 'nuevo_ticket')
                Se ha creado un nuevo ticket
            @endif
            @if ($tipo_notificacion == 'nuevo_seguimiento')
                Se ha agregado un nuevo seguimiento a un ticket
            @endif
            @if ($tipo_notificacion == 'nuevo_adjunto')
                Se ha agregado un nuevo archivo a un ticket
            @endif
            @if ($tipo_notificacion == 'cambio_estatus')
                Se ha cambiado el estatus de un ticket a <strong>{{ $ticket->estatus->nombre }}</strong>
            @endif

            a travéz del portal
            <a href="http://dotech.dyndns.biz:16666/alis_foods_hd" target="_BLANK">AlisFoods</a> por la sucursal
            <strong>{{ $ticket->autor->sucursal->nombre }}</strong>
            con el folio <strong>{{ $ticket->folio }}</strong> por el usuario
            <strong>{{ $ticket->autor->name }} {{ $ticket->autor->apaterno }} {{ $ticket->autor->amaterno }}</strong> en
            la categoria de
            <strong>{{ $ticket->sintoma->servicio->subcategoria->categoria->nombre }}</strong> subcategoría
            <strong><strong>{{ $ticket->sintoma->servicio->subcategoria->nombre }}</strong></strong>
            ,Tipo de servicio <strong>{{ $ticket->sintoma->servicio->nombre }}</strong> con síntoma
            <strong>{{ $ticket->sintoma->nombre }}</strong> con la siguiente descripción:
            <br><br>
            <i>"{{ $ticket->descripcion }}"</i>

        </p>
        Para dar seguimiento al ticket por favor ingrese al siguiente enlace:
        <br><br><br>
        <center>
            <a href="http://dotech.dyndns.biz:16666/alis_foods_hd" target="_BLANK" class="enlace">
                IR AL PORTAL
            </a>
        </center>
        <br>
        <br>
        <small>
            <b>
                La información contenida en este correo electrónico se considera material estrictamente confidencial.
                Por lo cual, cualquier uso que se le dé y que no se haya autorizado previamente por DOTECH., sus
                empresas subsidiarias y afiliadas, así como sus empleados debidamente facultados, se estará
                utilizando en contravención. El presente correo electrónico cumple efectos meramente informativos entre
                “DOTECH” y el receptor de este. Si usted recibió este mensaje por error, por favor contacte
                al emisor y borre su contenido de cualquier computadora en la que resida.
            </b>
        </small>
    </div>
</body>

</html>
