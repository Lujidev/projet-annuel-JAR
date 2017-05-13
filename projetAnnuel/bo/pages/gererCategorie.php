<?php
	require "conf.inc.php";
	require "lib.php";
	include "header.php";
	include "footer.php";


	$db = dbConnect();
	$query = $db->prepare("SELECT * FROM categories");
	$query->execute([]);
	$res = $query->fetchAll();
		
?>


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Catégories</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Gestion des catégories stockés en BDD
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>Id_categorie</th>
                                        <th>Nom_categorie</th>
                                        <th>Description_categorie(s)</th>
                                        <th>Filter</th>
                                        <th>Supprimer</th>
                                        <th>Modifier</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="odd gradeX">
										<?php gererCategories($res);?>
                                    </tr>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->

                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>

</div>


    <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
