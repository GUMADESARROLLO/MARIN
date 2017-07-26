<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
        <style>
        tbody td, thead th{ padding: 8px 10px;}
        #ClienteAdd{border-collapse: separate;border-spacing: 1px;color: white; font-family: 'robotoblack';}
        #ClienteAdd tbody td{color:#831f82;font-size: 11px;}
        #ClienteAdd tr:nth-child(even){background: #ffffff;}
        #ClienteAdd tr:nth-child(odd){ background: #e7e2f7; }
        #ClienteAdd th{ background: #831f82;color: #fff; font-size: 14px;}
        #logo{margin: 10px 15px 10px;}
        .negra{
            font-family: 'robotoblack'!important;
        }
        @font-face {
            font-family: 'robotoblack';
            src: url('roboto-black-webfont.eot');
            src: url('roboto-black-webfont.eot?#iefix') format('embedded-opentype'),
            url('roboto-black-webfont.woff2') format('woff2'),
            url('roboto-black-webfont.woff') format('woff'),
            url('roboto-black-webfont.ttf') format('truetype'),
            url('roboto-black-webfont.svg#robotoblack') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'robotobold';
            src: url('roboto-bold-webfont.eot');
            src: url('roboto-bold-webfont.eot?#iefix') format('embedded-opentype'),
            url('roboto-bold-webfont.woff2') format('woff2'),
            url('roboto-bold-webfont.woff') format('woff'),
            url('roboto-bold-webfont.ttf') format('truetype'),
            url('roboto-bold-webfont.svg#robotobold') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'robotomedium';
            src: url('roboto-medium-webfont.eot');
            src: url('roboto-medium-webfont.eot?#iefix') format('embedded-opentype'),
            url('roboto-medium-webfont.woff2') format('woff2'),
            url('roboto-medium-webfont.woff') format('woff'),
            url('roboto-medium-webfont.ttf') format('truetype'),
            url('roboto-medium-webfont.svg#robotomedium') format('svg');
            font-weight: normal;
            font-style: normal;
        }
        @font-face {
            font-family: 'robotoregular';
            src: url('roboto-regular-webfont.eot');
            src: url('roboto-regular-webfont.eot?#iefix') format('embedded-opentype'),
            url('roboto-regular-webfont.woff2') format('woff2'),
            url('roboto-regular-webfont.woff') format('woff'),
            url('roboto-regular-webfont.ttf') format('truetype'),
            url('roboto-regular-webfont.svg#robotoregular') format('svg');
            font-weight: normal;
            font-style: normal;
        }
    </style>
</head>
<body>
<div class="row" style="margin-bottom:0">
    <div class="col l2" style="margin-left:35%;" >
        <img id="logo" src="<?PHP echo base_url();?>assets/img/spinnova_logo.png" width="30%">
    </div>
</div>
<br>
<div style="text-align:center" class="">
<h3 style="font-family: 'robotoblack';font-size: 18px; color: #831f82; font-weight:bold;" >CLIENTES REGISTRADOS EN EL SISTEMA DE PUNTOS INNOVA (SPINN)</h3>
</div>
<table id="ClienteAdd">
    <thead>
        <tr>
            <th>CÓDIGO</th>
            <th>CLIENTE</th>
            <th>RUC</th>
            <th>DIRECCIÓN</th>
        </tr>
    </thead>
    <tbody>
    <?PHP
                if(!($Clientes)){
                    } else {
                        foreach($Clientes as $cliente){
                            echo "
                                 <tr>
                                    <td>".$cliente['CODIGO']."</td>
                                    <td class='negra'>".$cliente['NOMBRE']."</td>
                                    <td>".$cliente['RUC']."</td>
                                    <td>".$cliente['DIRECCION']."</td>
                                 </tr>
                            ";
                        }
                    }
                ?>
    </tbody>
</table>
</div>
</body>
</html>