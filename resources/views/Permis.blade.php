<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
            @page { size: 10cm 15cm landscape; }
     
    img{
        float:left;
            height: 3cm;
            width: 2cm;

        }
            p{
            font-size: 15px;
        }
            .dd{
            float:right;
            height: 8cm;
            width: 3cm;
            font-size: 15px;

        }
    </style>
</head>
<body >
      <img src='F:\icon\images.jpg' height="3px" width="2cm" style="float:left"/>
       <div class="dd">
        <p>{{$data['data1']->nom}}</p>
        <p>{{$data['data1']->prenom}}</p>
        <p>{{$data['data1']->date_naissance}}</p>
        <p>{{$data['data1']->cin}}</p>
        <p>{{$data['data1']->adresse}}</p></div>
</body>