<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
                
            }

            body {
                margin: 0;
                padding: 0;
                
                display: table;
                font-weight: 100;
                font-family: "Lucida Console";
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 40px;
            }
            textarea {
                width: 250px;
                height: 100px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <p class="title">Test Wdna</p>
                @foreach($list as $value)
                    @if ( $value->status == 'UNANSWERED' )
                <?php

                     
                        echo Form::open(array('url' => 'mlquestions')); 
                        echo 
                        '
                            <p>  ' . $value->text . ' </p>
                            ' . Form::textarea('comment', 'Your ML Answer goes here!') . '                               
                            ' . Form::hidden('id', $value->id ) . '
                            ' . Form::hidden('code', $_GET['code'] ) . '
                            ' . Form::submit('Answer') . '
                        '
                        ;    
                        echo Form::close();
 
                ?>
                 @endif
              @endforeach
            </div>
        </div>
    </body>
</html>
