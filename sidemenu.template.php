			<!-- uncomment code for absolute positioning tweek see top comment in css -->
		    <!-- <div class="absolute-wrapper"> </div> -->
		    <!-- Menu -->
		    <div class="side-menu">
		    
			    <nav class="navbar navbar-default" role="navigation">
				    <!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				        <div class="brand-wrapper">
				            <!-- Hamburger -->
				            <button type="button" class="navbar-toggle">
				                <span class="sr-only">Toggle navigation</span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				                <span class="icon-bar"></span>
				            </button>

				            <!-- Brand -->
				            <div class="brand-name-wrapper">
				                <a class="navbar-brand" href="#">
				                    Welcome <?php echo $_SESSION['acc_username'] ?>
				                </a>
				            </div>

				            <!-- Search -->
				            <!-- <a data-toggle="collapse" href="#search" class="btn btn-default" id="search-trigger">
				                <span class="glyphicon glyphicon-search"></span>
				            </a> -->

				            <!-- Search body -->
				            <div id="search" class="panel-collapse collapse">
				                <div class="panel-body">
				                    <form class="navbar-form" role="search">
				                        <div class="form-group">
				                            <input type="text" class="form-control" placeholder="Search">
				                        </div>
				                        <button type="submit" class="btn btn-default "><span class="glyphicon glyphicon-ok"></span></button>
				                    </form>
				                </div>
				            </div>
				        </div>

				    </div>

				    <!-- Main Menu -->
				    <div class="side-menu-container">
				        <ul class="nav navbar-nav">
				            <!-- Dropdown-->
				            <li class="panel panel-default" id="dropdown">
				                <a data-toggle="collapse" href="#dr-akuntansi">
				                    <span class="glyphicon glyphicon-user"></span> Master Akuntansi <span class="caret"></span>
				                </a>

				                <!-- Dropdown level 1 -->
				                <div id="dr-akuntansi" class="panel-collapse collapse">
				                    <div class="panel-body">
				                        <ul class="nav navbar-nav">
				                            <li><a href="master_tipeperusahaan.php">Master Tipe Perusahaan</a></li>
				                            <li><a href="master_akun.php">Master Akun</a></li>
				                            <li><a href="master_kelompokakun.php">Master Kelompok Akun</a></li>
				                        </ul>
				                    </div>
				                </div>
				            </li>

				            <li class="panel panel-default" id="dropdown">
				                <a data-toggle="collapse" href="#dr-perusahaan">
				                    <span class="glyphicon glyphicon-user"></span> Master Perusahaan <span class="caret"></span>
				                </a>

				                <!-- Dropdown level 1 -->
				                <div id="dr-perusahaan" class="panel-collapse collapse">
				                    <div class="panel-body">
				                        <ul class="nav navbar-nav">
				                            <li><a href="#">Master Data Perusahaan</a></li>
				                            <li><a href="#">Master Data Aset</a></li>
				                            <li><a href="master_barang.php">Master Data Barang</a></li>
				                            <li><a href="#">Lihat Data Pegawai</a></li>
				                            <li><a href="#">Lihat Data Customer</a></li>
				                            <li><a href="#">Lihat Data Supplier</a></li>
				                        </ul>
				                    </div>
				                </div>
				            </li>

				            <li class="panel panel-default" id="dropdown">
				                <a data-toggle="collapse" href="#dr-jurnal">
				                    <span class="glyphicon glyphicon-user"></span> Jurnal <span class="caret"></span>
				                </a>

				                <!-- Dropdown level 1 -->
				                <div id="dr-jurnal" class="panel-collapse collapse">
				                    <div class="panel-body">
				                        <ul class="nav navbar-nav">
				                            <li><a href="#">Jurnal Transaksi</a></li>
				                            <li><a href="#">Jurnal Pegawai</a></li>
				                            <li><a href="#">Jurnal Kegiatan</a></li>
				                            <li><a href="#">Lihat Jurnal Aset</a></li>
				                        </ul>
				                    </div>
				                </div>
				            </li>

				            <li class="panel panel-default" id="dropdown">
				                <a data-toggle="collapse" href="#dr-laporan">
				                    <span class="glyphicon glyphicon-user"></span> Laporan <span class="caret"></span>
				                </a>

				                <!-- Dropdown level 1 -->
				                <div id="dr-laporan" class="panel-collapse collapse">
				                    <div class="panel-body">
				                        <ul class="nav navbar-nav">
				                            <li><a href="#">Laporan Laba Rugi</a></li>
				                            <li><a href="#">Laporan Neraca</a></li>
				                            <li><a href="#">Laporan FA</a></li>
				                        </ul>
				                    </div>
				                </div>
				            </li>

				            <li class="active"><a href="#"><span class="glyphicon glyphicon-plane"></span> Active Link</a></li>

				        </ul>
				    </div><!-- /.navbar-collapse -->
				</nav>
		    
		    </div>