<?php

if(!true)exit();//ako nije ulogiran
include "../config.php";
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Table V04</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="robots" content="noindex, follow" />

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Lato&display=swap"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="manual.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script>
        
      $(document).ready(function(){
        $("input").change(function(){
            if($(this).val() == $(this).attr('placeholder')){
                $(this).removeClass("changed");
            }
            else {
                $(this).addClass("changed");
            }
        });
        $("option").each(function(){
          if($(this).parent().attr("value") == $(this).attr("value")){
            $(this).addClass("default");
            $(this).attr("selected","selected");
          }
          if ($(this).parent().attr("value")>3 && $(this).attr("value")>3){
            $(this).addClass("default");
            $(this).attr("selected","selected");
          }
        })

        $("select").on('change', function() {
          console.log(this.value);
            if(this.value == $(this).attr("value")){
              $(this).removeClass("changed");
            }else{
              $(this).addClass("changed");
            }
        });
        });

        document.onkeydown=function(evt){
        var keyCode = evt ? (evt.which ? evt.which : evt.keyCode) : event.keyCode;
        if(keyCode == 13)
        {
            document.test.submit();
        }
    }
    </script>
  </head>
  <body>
    <div class="limiter">
      <div class="container-table">
        <div class="wrap-table">
            <form action="#" method="POST">
            <h1 class="title">CVOR</h1>
                <div class="table CVOR">
                    <div class="table-head">
                    <table>
                        <thead>
                        <tr class="row head">
                            <th class="cell column1">ID</th>
                            <th class="cell column2">MAC</th>
                            <th class="cell column3">AKTIVNO</th>
                        </tr>
                        </thead>
                    </table>
                    </div>
                    <div class="table-body js-pscroll">
                    <table>
                        <tbody>
                          <?php
                            $sql_query = "SELECT * FROM CVOR ";//WHERE VRIJEME >= NOW() - INTERVAL 1 DAY
                            $result = mysqli_query($con, $sql_query);
                            $index=0;
                            while ($row = mysqli_fetch_array($result)){
                              echo "<tr class='row body'>";
                              echo "<td class='cell column1'> <input name='CVOR[".$index."][ID]' type='number' placeholder='".$row['ID']."' value='".$row['ID']."'></td>";
                              echo "<td class='cell column2'> <input name='CVOR[".$index."][MAC]' type='text' placeholder='".$row['MAC']."' value='".$row['MAC']."'></td>";
                              echo "<td class='cell column4'> <select name='CVOR[".$index."][AKTIVNO]' value=".$row['AKTIVNO'].">
                                                                <option value=0>aktivan</option>
                                                                <option value=1>neaktivan</option>
                                                                </select></td>";
                              echo "</tr>";
                              }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <h1 class="title">TEMP_SENZOR</h1>
                <div class="table TEMP_SENZOR">
                
                  <div class="table-head">
                    
                  <table>
                      <thead>
                      <tr class="row head">
                          <th class="cell column1">ID</th>
                          <th class="cell column2">ID_CVOR</th>
                          <th class="cell column3">ADRESA</th>
                          <th class="cell column4">TIP</th>
                      </tr>
                      </thead>
                  </table>
                  </div>
                  <div class="table-body js-pscroll">
                  <table>
                      <tbody>
                        <?php
                          $sql_query = "SELECT * FROM TEMP_SENZOR ";//WHERE VRIJEME >= NOW() - INTERVAL 1 DAY
                          $result = mysqli_query($con, $sql_query);
                          $index=0;
                          while ($row = mysqli_fetch_array($result)){
                            echo "<tr class='row body'>";
                            echo "<td class='cell column1'> <input name='TEMP_SENZOR[".$index."][ID]' type='number' placeholder='".$row['ID']."' value='".$row['ID']."'></td>";
                            echo "<td class='cell column2'> <input name='TEMP_SENZOR[".$index."][ID_CVOR]' type='number' placeholder='".$row['ID_CVOR']."' value='".$row['ID_CVOR']."'></td>";
                            echo "<td class='cell column3'> <input name='TEMP_SENZOR[".$index."][ADRESA]' type='text' placeholder='".$row['ADRESA']."' value='".$row['ADRESA']."'></td>";
                            echo "<td class='cell column4'> <select name='TEMP_SENZOR[".$index."][TIP]' value=".$row['TIP'].">
                                                              <option value=0>Sobna</option>
                                                              <option value=1>Radijator</option>
                                                              <option value=2>Klima</option>
                                                              <option value=100>Nije Definiran</option>
                                                              </select></td>";
                            echo "</tr>";
                            }
                          ?>
                      </tbody>
                  </table>
                  </div>
              </div>
            </form>
        </div>
      </div>
    </div>
  </body>
</html>
