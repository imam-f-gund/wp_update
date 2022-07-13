<?php 
include 'db/database.php';

//update
// echo $_POST['ubah'];
if (isset($_POST['ubah'])){
    
    $id =$_POST["id"];
    $atribut =$_POST["atribut"];
    $c1 =$_POST["c1"];
  
    $sql = "UPDATE data SET Atribut = '$atribut', C1 = '$c1' where id='$id'";

    if ($mysqli->query($sql) === TRUE) {
       
        echo "<script> alert('success'); location.href='wp.php';</script>";
        
    
    } else {
        echo "<script>alert('Tidak Berhasil Ditambah');</script>";
        header("location:wp.php");
    }
        $mysqli->close();     
    
}
//add
// echo $_POST['tambah'];
if (isset($_POST['tambah'])){
    
        $atribut =$_POST["atribut"];
        $c1 =$_POST["c1"];
      
        $sql = "INSERT INTO data (Atribut, C1)
        VALUES ('$atribut', '$c1')";

        if ($mysqli->query($sql) === TRUE) {
           
            echo "<script> alert('success'); location.href='wp.php';</script>";
            
        
        } else {
            echo "<script>alert('Tidak Berhasil Ditambah');</script>";
            header("location:wp.php");
        }
            $mysqli->close();     
        
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="asset/sbadmin/css/sb-admin-2.min.css" rel="stylesheet">

    <link href="asset/sbadmin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <title>Perhitungan WP</title>
</head>
<body>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md">
                <div class="card border-3 border-dark">
                    <div class="card-body">
                        <div class="card-title text-center"><strong>Tahap Ke Satu</strong><h4>Bobot Kepentingan</h4></div>
                        <div class="table-responsive"> 
                        <table id="example2" class="example table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Tipe</th>
                            <th>Kriteria</th>
                            <th>Tingkat Kepentingan</th>
                            <th>Bobot</th>
                            <th>Normalisasi Bobot</th>
                            <th class="text-center">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                           $t_kep = [];
                           $t_bobot = [];
                           $t_bobot_normalisasi = [];
                           $sql = "select * from bobot_kepentingan";
                           $result = $mysqli->query($sql);
                           $results = $mysqli->query($sql);
                           $no = 1;
                       
                           if ($result->num_rows > 0) {
                               // output data of each row
                               while($rows = $result->fetch_assoc()) {
                               array_push($t_kep,$rows["Tingkat_Kep"]);
                               array_push($t_bobot,$rows["Bobot"]);
                            }
                            $total_bobot = (array_sum($t_bobot));
                        }
                        if ($results->num_rows > 0) {
                            // output data of each row
                            while($row = $results->fetch_assoc()) {
                                if ($row["TIPE"] == 'COST') {
                                array_push($t_bobot_normalisasi,-$row["Bobot"]/$total_bobot);
                                }else{
                                    array_push($t_bobot_normalisasi,$row["Bobot"]/$total_bobot);
                                }
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row["Kode"]; ?></td>
                            <td><?php echo $row["TIPE"]; ?></td>
                            <td><?php echo $row["Kriteria"]; ?></td>
                            <td><?php echo $row["Tingkat_Kep"]; ?></td>
                            <td><?php echo $row["Bobot"]; ?></td>
                            <?php if ($row["TIPE"] == 'COST') {?>
                            <td><?php echo -$row["Bobot"]/$total_bobot; }else{ ?></td>
                            <td><?php echo $row["Bobot"]/$total_bobot; }?></td>
                            <td><button type="submit" class=" ubahdata btn btn-outline-dark btn-lg" value="<?php echo $row['id'];?>" >Ubah</button></td>
                           
                        </tr>
                                
                               
                        <?php
                              }
                            }
                          
                        ?>
                           
                           </tbody>
                           <tr>
                            <td><strong>Total : </strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong><?php echo (array_sum($t_kep)); ?></strong></td>
                            <td><strong><?php echo (array_sum($t_bobot)); ?></strong></td><br>
                            <td><strong><?php echo (array_sum($t_bobot_normalisasi)); ?></strong></td>
                            <td></td>
                           </tr>
                          
                        </table>
                         </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md">
                <div class="card border-3 border-dark">
                    <div class="card-body">
                        <div class="card-title text-center"><strong>Data Tahap Ke Dua</strong><h4>Kriteria</h4></div>
                        <div>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                           Tambah
                        </button>
                        </div>
                        <div class="table-responsive"> 
                        <table id="example2" class="example table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>C1</th>
                            <th>C2</th>
                            <th>C3</th>
                            <th>C4</th>
                            <th>C5</th>
                            <th>C6</th>
                            <th>C7</th>
                            <th>C8</th>
                            <th>C9</th>
                            <th>C10</th>
                            <th>C11</th>
                            <th>C12</th>
                            <th>C13</th>
                            <th class="text-center">Ubah</th> 
                            <th class="text-center">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                           $sql = "select * from data";
                           $result = $mysqli->query($sql);
                           $no = 1;
                           if ($result->num_rows > 0) {
                               // output data of each row
                               while($row = $result->fetch_assoc()) {
                                  
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row["Atribut"]; ?></td>
                            <td><?php echo $row["C1"]; ?></td>
                            <td><?php echo $row["C2"]; ?></td>
                            <td><?php echo $row["C3"]; ?></td>
                            <td><?php echo $row["C4"]; ?></td>
                            <td><?php echo $row["C5"]; ?></td>
                            <td><?php echo $row["C6"]; ?></td>
                            <td><?php echo $row["C7"]; ?></td>
                            <td><?php echo $row["C8"]; ?></td>
                            <td><?php echo $row["C9"]; ?></td>
                            <td><?php echo $row["C10"]; ?></td>
                            <td><?php echo $row["C11"]; ?></td>
                            <td><?php echo $row["C12"]; ?></td>
                            <td><?php echo $row["C13"]; ?></td>
                            <td>
                            <button type="button" class="btn btn-secondary editdatautama" data-toggle="modal" data-target="#exampleModaledit" value="<?php echo $row['id'].'|'.$row['Atribut'].'|'.$row['C1'];?>">
                            Ubah
                            </button></td>
                            <form class="mt-5" method="post">
                            <input type="text" name="delete" value="<?php echo $row['id'];?>" hidden>
                            <td><button type="submit" class="btn btn-outline-warning btn-lg" >Hapus</button></td>
                            </form>
                        </tr>
                                
                               
                        <?php
                                }
                            }
                          
                        ?>
                           
                           </tbody>
                        </table>
                        </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                        <form class="mt-5" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="studi" class="col-sm-5 col-form-label">atribut/nama</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="atribut" name="atribut">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="studi" class="col-sm-5 col-form-label">Criteria 1</label>
                                        <div class="col-sm-7">
                                            <input type="number" class="form-control" id="c1" name="c1">
                                        </div>
                                    </div> 
                                    
                                </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="tambah" value="tambah">Save changes</button>
                            </div>
                        </div>
                        </form>
    </div>
    </div>
  </div>
</div>

 <!-- Modal Edit -->
<div class="modal fade" id="exampleModaledit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
                        <form class="mt-5" method="post">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row">
                                        <label for="studi" class="col-sm-5 col-form-label">atribut/nama</label>
                                        <div class="col-sm-7">
                                            <input type="text" class="form-control" id="id" name="id" hidden>
                                            <input type="text" class="form-control" id="editatribut" name="atribut">
                                        </div>
                                    </div> 
                                    <div class="form-group row">
                                        <label for="studi" class="col-sm-5 col-form-label">Criteria 1</label>
                                        <div class="col-sm-7">
                                            <input type="number" class="form-control" id="editc1" name="c1">
                                        </div>
                                    </div> 
                                    
                                </div>
                                </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="ubah" value="ubah">Save changes</button>
                            </div>
                        </div>
                        </form>
    </div>
    </div>
  </div>
</div>
    
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md">
                <div class="card border-3 border-dark">
                    <div class="card-body">
                        <div class="card-title text-center"><strong>Data Tahap Ke Tiga</strong><h4>NILAI VEKTOR S</h4></div>
                        <div class="table-responsive"> 
                        <table id="example" class="example table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>C1</th>
                            <th>C2</th>
                            <th>C3</th>
                            <th>C4</th>
                            <th>C5</th>
                            <th>C6</th>
                            <th>C7</th>
                            <th>C8</th>
                            <th>C9</th>
                            <th>C10</th>
                            <th>C11</th>
                            <th>C12</th>
                            <th>C13</th>
                            <th>Vektor S</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                        $arr_vektor_s = [];
                           $sql = "select * from data";
                           $result = $mysqli->query($sql);
                           $no = 1;
                           $count_t_bobot_normalisasi = count($t_bobot_normalisasi);
                          
                           if ($result->num_rows > 0) {
                               // output data of each row
                               
                               while($row = $result->fetch_assoc()) {

                            //    $vektor_s = number_format((pow($row["C1"],$t_bobot_normalisasi[0]))*(pow($row["C2"],$t_bobot_normalisasi[1]))*(pow($row["C3"],$t_bobot_normalisasi[2]))*(pow($row["C4"],$t_bobot_normalisasi[3]))*(pow($row["C5"],$t_bobot_normalisasi[4]))*(pow($row["C6"],$t_bobot_normalisasi[5]))*(pow($row["C7"],$t_bobot_normalisasi[6]))*(pow($row["C8"],$t_bobot_normalisasi[7]))*(pow($row["C9"],$t_bobot_normalisasi[8]))*(pow($row["C10"],$t_bobot_normalisasi[9]))*(pow($row["C11"],$t_bobot_normalisasi[10]))*(pow($row["C12"],$t_bobot_normalisasi[11]))*(pow($row["C13"],$t_bobot_normalisasi[12])),4);
                            //    array_push($arr_vektor_s,$vektor_s);

                               $vektor_s = (pow($row["C1"],$t_bobot_normalisasi[0]))*(pow($row["C2"],$t_bobot_normalisasi[1]))*(pow($row["C3"],$t_bobot_normalisasi[2]))*(pow($row["C4"],$t_bobot_normalisasi[3]))*(pow($row["C5"],$t_bobot_normalisasi[4]))*(pow($row["C6"],$t_bobot_normalisasi[5]))*(pow($row["C7"],$t_bobot_normalisasi[6]))*(pow($row["C8"],$t_bobot_normalisasi[7]))*(pow($row["C9"],$t_bobot_normalisasi[8]))*(pow($row["C10"],$t_bobot_normalisasi[9]))*(pow($row["C11"],$t_bobot_normalisasi[10]))*(pow($row["C12"],$t_bobot_normalisasi[11]))*(pow($row["C13"],$t_bobot_normalisasi[12]));
                               array_push($arr_vektor_s,$vektor_s);
                               
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row["Atribut"]; ?></td>
                            <td><?php echo number_format(pow($row["C1"],$t_bobot_normalisasi[0]),4); ?></td>
                            <td><?php echo number_format(pow($row["C2"],$t_bobot_normalisasi[1]),4); ?></td>
                            <td><?php echo number_format(pow($row["C3"],$t_bobot_normalisasi[2]),4); ?></td>
                            <td><?php echo number_format(pow($row["C4"],$t_bobot_normalisasi[3]),4); ?></td>
                            <td><?php echo number_format(pow($row["C5"],$t_bobot_normalisasi[4]),4); ?></td>
                            <td><?php echo number_format(pow($row["C6"],$t_bobot_normalisasi[5]),4); ?></td>
                            <td><?php echo number_format(pow($row["C7"],$t_bobot_normalisasi[6]),4); ?></td>
                            <td><?php echo number_format(pow($row["C8"],$t_bobot_normalisasi[7]),4); ?></td>
                            <td><?php echo number_format(pow($row["C9"],$t_bobot_normalisasi[8]),4); ?></td>
                            <td><?php echo number_format(pow($row["C10"],$t_bobot_normalisasi[9]),4); ?></td>
                            <td><?php echo number_format(pow($row["C11"],$t_bobot_normalisasi[10]),4); ?></td>
                            <td><?php echo number_format(pow($row["C12"],$t_bobot_normalisasi[11]),4); ?></td>
                            <td><?php echo number_format(pow($row["C13"],$t_bobot_normalisasi[12]),4); ?></td>
                            <td><?php echo $vektor_s; ?></td>
                            
                        </tr>
                                
                               
                        <?php
                       
                                }
                            }
                          
                        ?>
                           
                           </tbody>
                           <td><strong>Total Vektor (S) :</strong> </td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><strong><?php $tot_vektor_s = number_format(array_sum($arr_vektor_s),4); echo $tot_vektor_s; ?></strong></td>
                        </table>
                       
                        </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md">
                <div class="card border-3 border-dark">
                    <div class="card-body">
                        <div class="card-title text-center"><strong>Data Tahap Ke Empat</strong><h4>mencari nilai vektor V = vektor s dibagi total vektor s</h4></div>
                        <div class="table-responsive"> 
                        <table id="tes" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Nilai Vektor (V)</th>
                            <th class="text-center" >action</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        <?php
                           $rangking = [];
                           $sql = "select * from data";
                           $result = $mysqli->query($sql);
                           $no = 1;
                           $int = 0;
                           $ints = 0;
                         
                           if ($result->num_rows > 0) {
                               // output data of each row
                               while($row = $result->fetch_assoc()) {
                                array_push($rangking,$arr_vektor_s[$ints++]/$tot_vektor_s);
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $row["Atribut"]; ?></td>
                            <td><?php echo $arr_vektor_s[$int++]/$tot_vektor_s ?></td>
                           <td><button type="submit" class="ubahdata btn btn-outline-dark btn-lg" value="<?php echo $row['id'];?>" >Lihat</button></td>
                        </tr>
                                
                               
                        <?php
                              }
                            }
                          
                        ?>
                           
                           </tbody>
                           <td><strong>Total </strong></td>
                           <td></td>
                           <td><strong><?php  echo number_format(array_sum($rangking),2); ?></strong></td> 
                           <td></td>
                        </table>
                        </div>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="asset/sbadmin/vendor/jquery/jquery.min.js"></script>
    <script src="asset/sbadmin/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="asset/sbadmin/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="asset/sbadmin/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="asset/sbadmin/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="asset/sbadmin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="asset/sbadmin/js/demo/datatables-demo.js"></script>

<script>
$(document).ready( function () {
    $('.example').DataTable(); 
    $('#tes').DataTable({
        "order": [[ 2, "desc" ]]
    });
   
} );
    $(".editdatautama").on( "click", function() {
        var data = $(this).attr('value');
        data = data.split('|');
         console.log(data);
  
        $("#id").val(data[0]);
        $("#editatribut").val(data[1]);
        $("#editc1").val(data[2]);
    
        });
</script>
</body>

</html>