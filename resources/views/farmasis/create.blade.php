@extends('layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Tambah farmasi</h1>
        </div>

        <div class="section-body">

            <div class="card">
                <div class="card-header">
                    <h4><i class="fas fa-exam"></i> Tambah farmasi</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('farmasis.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form row">

                            <div class="form-group col-md-3 ">
                                <label>Tanggal</label>
                                <input type="date" name="waktu" value="<?= date('Y-m-d'); ?>" class="form-control @error('start') is-invalid @enderror">
                                @error('waktu')
                                <div class="invalid-feedback" style="display: block">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-3 ">
                                <label>Nama Pasien</label>
                                <input type="text" name="nama_px" class="form-control">
                            </div>
                            <div class="form-group col-md-3">
                                <label>No_RM</label>
                                <input type="text" name="no_rm" class="form-control" pattern="\d*" title="Hanya angka yang diperbolehkan">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label>Total Obat Fornas</label>
                                <input type="number" name="total_obat_fornas[]" class="form-control" id="total_obat_fornas" readonly>
                            </div>
                            <div class="form-group col-md-3">
                                <label>Total Item</label>
                                <input type="number" name="total_item[]" class="form-control" id="total_item" readonly>
                            </div>
                        </div>
                        <div id="obat-container">
                            <!-- List nama obat -->
                            <div class="form-row">
                                <div class="form-group col-md-3 ">
                                    <label>R/</label>
                                    <input type="number" name="r[]" class="form-control">
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Nama Obat</label>
                                    <input type="text" name="nama_obat[]" class="form-control" list="obat_list" onchange="updateTotals()">
                                    <datalist id="obat_list">
                                        <option value="ABBOCATH 16                                      "></option>
                                        <option value="ABBOCATH 18                                      "></option>
                                        <option value="ABBOCATH 18                                      "></option>
                                        <option value="ABBOCATH 20                                      "></option>
                                        <option value="ABBOCATH 22                                      "></option>
                                        <option value="ABBOCATH 24                                      "></option>
                                        <option value="ABBOCATH 26                                      "></option>
                                        <option value="ALKOHOL SWAB"></option>
                                        <option value="BACTUGRAT"></option>
                                        <option value="BD JARUM INSULIN"></option>
                                        <option value="BISTURI 20"></option>
                                        <option value="BISTURI 22"></option>
                                        <option value="CANUL ANAK"></option>
                                        <option value="CANUL BAYI"></option>
                                        <option value="CANUL DEWASA"></option>
                                        <option value="CHROMIC C99"></option>
                                        <option value="CHROMIC CATGUT 3/0"></option>
                                        <option value="CHROMIC CATGUT 3/0"></option>
                                        <option value="CUTIMAT SORBECT"></option>
                                        <option value="DC 8"></option>
                                        <option value="DC 12"></option>
                                        <option value="DC14"></option>
                                        <option value="DC 16"></option>
                                        <option value="DC 22"></option>
                                        <option value="DERMAFIK 6 X 7"></option>
                                        <option value="DERMAFIX 10 X 25"></option>
                                        <option value="DERMAFIX 10 X 8"></option>
                                        <option value="ELEKTRODA ( KOTAK )"></option>
                                        <option value="ELETRODA ( BULAT )"></option>
                                        <option value="ENDOTRACEAL TUBE 6,0"></option>
                                        <option value="ENDOTRACEAL TUBE 6,5"></option>
                                        <option value="ETT 3.0"></option>
                                        <option value="EXTENTION TUBE 1,5"></option>
                                        <option value="GAMEX 8"></option>
                                        <option value="GUEDEL 80MM"></option>
                                        <option value="GUEDEL 90MM"></option>
                                        <option value="HS S"></option>
                                        <option value="HS L"></option>
                                        <option value="HS M"></option>
                                        <option value="HS XS"></option>
                                        <option value="HS MAXTER 8 (PANJANG)"></option>
                                        <option value="HS MAXTER 8 (PANJANG)"></option>
                                        <option value="HS NO 7,5"></option>
                                        <option value="HS NO 7"></option>
                                        <option value="HS MAXTER NO 6,5"></option>
                                        <option value="HYPAFIX"></option>
                                        <option value="KASA STERIL"></option>
                                        <option value="KERTAS EKG ALL SIZE"></option>
                                        <option value="KERTAS USG"></option>
                                        <option value="KORSET XL"></option>
                                        <option value="MAKRO SET"></option>
                                        <option value="MAKRO SET"></option>
                                        <option value="MAKRO SET"></option>
                                        <option value="MAXTER 8"></option>
                                        <option value="MIKRO SET"></option>
                                        <option value="MIKRO SET"></option>
                                        <option value="MIKRO SET"></option>
                                        <option value="MY JELLY"></option>
                                        <option value="NASAL PRONG 3020"></option>
                                        <option value="NASAL PRONG 801"></option>
                                        <option value="NASAL PRONG BC 3520"></option>
                                        <option value="NASAL PRONG BC 800"></option>
                                        <option value="NEBUL ANAK"></option>
                                        <option value="NEBUL DEWASA"></option>
                                        <option value="NEBUL DEWASA"></option>
                                        <option value="NEEDLE 23"></option>
                                        <option value="NEEDLE 25"></option>
                                        <option value="NEEDLE 26"></option>
                                        <option value="NEEDLE 26"></option>
                                        <option value="NGT 12"></option>
                                        <option value="NGT 12"></option>
                                        <option value="NGT 14"></option>
                                        <option value="NGT 18"></option>
                                        <option value="NOVOSYN 2/0"></option>
                                        <option value="NRM ANAK"></option>
                                        <option value="NRM DEWASA"></option>
                                        <option value="NURSE CAP"></option>
                                        <option value="OPSITE BESAR"></option>
                                        <option value="OPSITE KECIL"></option>
                                        <option value="OPTIME 2/0"></option>
                                        <option value="PLESTER COKLAT ( BESAR )"></option>
                                        <option value="PLESTER COKLAT (KECIL)"></option>
                                        <option value="RING PESSARIUM 65"></option>
                                        <option value="RING PESSARIUM 80"></option>
                                        <option value="ROMELE NO.8"></option>
                                        <option value="SIGMA CRÈME"></option>
                                        <option value="SILK 1 PS84"></option>
                                        <option value="SILK 3 PS23"></option>
                                        <option value="SILK 3/0 32mm"></option>
                                        <option value="SILK 3/0 WITHOUT NEEDLE"></option>
                                        <option value="SPINOCANE 26"></option>
                                        <option value="SPONS FOR SURGICAL"></option>
                                        <option value="SPUIT 10 CC"></option>
                                        <option value="SPUIT 10CC"></option>
                                        <option value="SPUIT 1CC"></option>
                                        <option value="SPUIT 20CC"></option>
                                        <option value="SPUIT 20CC"></option>
                                        <option value="SPUIT 3CC ONEMED"></option>
                                        <option value="SPUIT 3CC TERUMO"></option>
                                        <option value="SPUIT 50CC LP"></option>
                                        <option value="SPUIT 50CC LP"></option>
                                        <option value="SPUIT 50CC LP TERUMO"></option>
                                        <option value="SPUIT 50CC LP"></option>
                                        <option value="SPUIT 5CC"></option>
                                        <option value="SPUIT 5CC"></option>
                                        <option value="SUCTION NO. 8"></option>
                                        <option value="SUTURE NEEDLE HECTING NO. 10"></option>
                                        <option value="SUTURE NEEDLE HECTING NO. 11"></option>
                                        <option value="SUTURE NEEDLE HECTING NO. 12"></option>
                                        <option value="SUTURE NEEDLE HECTING NO. 13"></option>
                                        <option value="SUTURE NEEDLE HECTING NO. 15"></option>
                                        <option value="SUTURE NEEDLE HECTING NO. 7"></option>
                                        <option value="SUTURE NEEDLE HECTING NO. 8"></option>
                                        <option value="SUTURE NEEDLE HECTING NO. 9"></option>
                                        <option value="T- CHROMIC C27"></option>
                                        <option value="T- VIO 15"></option>
                                        <option value="T- VIO 12"></option>
                                        <option value="T- VIO 40"></option>
                                        <option value="THREEWAY + SELANG"></option>
                                        <option value="THREEWAY TANPA SELANG"></option>
                                        <option value="T-PLAIN P88"></option>
                                        <option value="T-PLAIN PP32"></option>
                                        <option value="T-PLAIN PP33"></option>
                                        <option value="TRANFUSI SET"></option>
                                        <option value="TRANFUSI SET"></option>
                                        <option value="TRANFUSI SET"></option>
                                        <option value="TRANSOFIK"></option>
                                        <option value="T-VIO 12"></option>
                                        <option value="UNDERPAD"></option>
                                        <option value="URINE BAG"></option>
                                        <option value="WOUND DRESSINGS 10CM X 25CM"></option>
                                        <option value="VASELME SWAB"></option>
                                        <option value="ACARBOSE 100"></option>
                                        <option value="ACARBOSE 50"></option>
                                        <option value="ACETYLCYSTEINE 200 MG"></option>
                                        <option value="ACICLOVIR 400MG"></option>
                                        <option value="ACICLOVIR 200MG"></option>
                                        <option value="ALLOPURINOL 100"></option>
                                        <option value="ALLOPURINOL 300"></option>
                                        <option value="AMBROXOL"></option>
                                        <option value="AMIODARONE"></option>
                                        <option value="AMLODIPIN 10"></option>
                                        <option value="AMLODIPIN 5"></option>
                                        <option value="AMOXCILIN 500MG"></option>
                                        <option value="ANTASIDA DOEN"></option>
                                        <option value="ASAM ASETILSAILSILAD 80MG"></option>
                                        <option value="ASAM FOLAT"></option>
                                        <option value="ASAM MEFENAMAT"></option>
                                        <option value="ASAM VALPROAT 250MG"></option>
                                        <option value="ASAM VALPROAT 500MG"></option>
                                        <option value="ATORVASTATIN 20"></option>
                                        <option value="ATORVASTATIN 20"></option>
                                        <option value="AZITROMYCHI 500MG"></option>
                                        <option value="BETAHISTINE"></option>
                                        <option value="BIKARBONAT SODIUM"></option>
                                        <option value="BISOPROLOL 10"></option>
                                        <option value="BISOPROLOL 2,5 MG"></option>
                                        <option value="BISOPROLOL 5"></option>
                                        <option value="CANDESARTAN 16"></option>
                                        <option value="CANDESARTAN 8"></option>
                                        <option value=" CAPTOPRIL 12.5"></option>
                                        <option value="CAPTOPRIL 12.5"></option>
                                        <option value="CAPTOPRIL 25"></option>
                                        <option value="CARBAMAZEPIN 200MG"></option>
                                        <option value="CEFADROXIL"></option>
                                        <option value="CEFIXIM 100"></option>
                                        <option value="CEFIXIM 200"></option>
                                        <option value="CETIRIZIN"></option>
                                        <option value="CHLOROQUIN 100"></option>
                                        <option value="CILOSTAZOLE 100MG"></option>
                                        <option value="CIMETIDIN"></option>
                                        <option value="CIPROFLOXACIN"></option>
                                        <option value="CITICOLIN 500"></option>
                                        <option value="CLINAMICYN 300"></option>
                                        <option value="CLINDAMYCIN"></option>
                                        <option value="CLINDAMYCIN"></option>
                                        <option value="CLONIDINE"></option>
                                        <option value="CLOPIDOGREL"></option>
                                        <option value="CLOROQUIN"></option>
                                        <option value="COTRIMOXAZOLE"></option>
                                        <option value="CTM"></option>
                                        <option value="DEXAMETASHON"></option>
                                        <option value="DEXKETOPROFEN"></option>
                                        <option value="DIGOXIN"></option>
                                        <option value="DILTIAZEM 30"></option>
                                        <option value="DIMENHIDRINATE"></option>
                                        <option value="DIVALPROEX SODIUM 250MG"></option>
                                        <option value="DIVALPROEX SODIUM 500MG"></option>
                                        <option value="DOMPERIDON"></option>
                                        <option value="DONEPAZIL 5MG"></option>
                                        <option value="DOXYCYCLINE"></option>
                                        <option value="EPERISONE"></option>
                                        <option value="ERDOSTEIN"></option>
                                        <option value="ERITROMYCIN (ERYSANBE)"></option>
                                        <option value="ERYTROMICIN"></option>
                                        <option value="ESOMEPRAZOLE"></option>
                                        <option value="ETORICOXIB 120MG"></option>
                                        <option value="EUTHYROX 50"></option>
                                        <option value="FENOFIBRAT 100"></option>
                                        <option value="FENOFIBRAT 100"></option>
                                        <option value="FENOFIBRAT 100"></option>
                                        <option value="FENOFIBRAT 300"></option>
                                        <option value="FENOFIBRATE 300MG"></option>
                                        <option value="FOLIC ACID"></option>
                                        <option value="FLUNARIZIN"></option>
                                        <option value="FLUNARIZIN"></option>
                                        <option value="FLUNARIZIN"></option>
                                        <option value="FLUOXETIN 20MG"></option>
                                        <option value="FUROSEMID"></option>
                                        <option value="GABAPENTIN 100MG"></option>
                                        <option value="GABAPENTIN 300"></option>
                                        <option value="GG"></option>
                                        <option value="GLAUSETA"></option>
                                        <option value="GLICLAZIDE 80"></option>
                                        <option value="GLIMEPIRID 1"></option>
                                        <option value="GLIMEPIRID 2"></option>
                                        <option value="GLIMEPIRID 3"></option>
                                        <option value="GLIMEPIRID 4"></option>
                                        <option value="GLIQUIDON"></option>
                                        <option value="GRISEOFULVIN"></option>
                                        <option value="GUAIFENESIN"></option>
                                        <option value="HCT"></option>
                                        <option value="HEXYMER"></option>
                                        <option value="IBUPROFEN 400"></option>
                                        <option value="IRBESARTAN 150"></option>
                                        <option value="IRBESARTAN 300"></option>
                                        <option value="ISONIAZID 300"></option>
                                        <option value="ISOSORBIT DINITRAT"></option>
                                        <option value="KALIUM DIKLOFENAK"></option>
                                        <option value="KALK"></option>
                                        <option value="KETOKENAZOLE"></option>
                                        <option value="KETOPROFEN"></option>
                                        <option value="KETOROLAC 10 MG"></option>
                                        <option value="LEVOFLOXACIN 500 MG"></option>
                                        <option value="LISINOPRIL 10MG"></option>
                                        <option value="LISINOPRIL 5"></option>
                                        <option value="LORATADINE 10MG"></option>
                                        <option value="LOPERAMIDE 2  MG"></option>
                                        <option value="MECOBALAMIN 500MG"></option>
                                        <option value="MELOXICAM 15"></option>
                                        <option value="MELOXICAM 7.5MG"></option>
                                        <option value="METFORMIN 500"></option>
                                        <option value="METFORMIN 850"></option>
                                        <option value="METHYLPREDNISOLON 4MG"></option>
                                        <option value="METHYLPREDNISOLON 8MG"></option>
                                        <option value="METRONIDAZOLE"></option>
                                        <option value="MINIASPI"></option>
                                        <option value="MISOPROSTOL"></option>
                                        <option value="MISOPROSTOL"></option>
                                        <option value="MP 16MG"></option>
                                        <option value="MP 4MG"></option>
                                        <option value="NATRIUM DIKOFLENAK 50MG"></option>
                                        <option value="NIFEDIPIN"></option>
                                        <option value="NORESTHITERON"></option>
                                        <option value="OMEPRAZOLE"></option>
                                        <option value="ONDACENTRON 8MG"></option>
                                        <option value="ONDANCETRON 4 MG"></option>
                                        <option value="ORALIT"></option>
                                        <option value="OSELTAMIVIR"></option>
                                        <option value="PARACETAMOL 500MG"></option>
                                        <option value="PARACETAMOL 650MG"></option>
                                        <option value="PHENITOIN 100MG"></option>
                                        <option value="PIOGLITAZONE 15 MG"></option>
                                        <option value="PIOGLITAZONE 30"></option>
                                        <option value="PIRACETAM 1200"></option>
                                        <option value="PIRACETAM 400 MG"></option>
                                        <option value="PIRACETAM 800 MG"></option>
                                        <option value="PREDNISON"></option>
                                        <option value="PREGABALIN 75MG"></option>
                                        <option value="PROPANOLOL 10MG"></option>
                                        <option value="PROPANOLOL 40"></option>
                                        <option value="PROPYLTHIOURACIL 100"></option>
                                        <option value="PYRAZINAMID 500"></option>
                                        <option value="RAMIPRIL 10"></option>
                                        <option value="RAMIPRIL 5"></option>
                                        <option value="RANITIDIN"></option>
                                        <option value="REBAMIPID"></option>
                                        <option value="RIFAMPICIN 450MG"></option>
                                        <option value="RIFAMPICIN 600MG"></option>
                                        <option value="RISPERIDON 2MG"></option>
                                        <option value="ROSUVASTATI 20MG"></option>
                                        <option value="ROSUVASTATIN 10MG"></option>
                                        <option value="SALBUTAMOL  2MG"></option>
                                        <option value="SALBUTAMOL  4MG"></option>
                                        <option value="SILDENAFIL 100"></option>
                                        <option value="SIMVASTATIN 10"></option>
                                        <option value="SIMVASTATIN 20MG"></option>
                                        <option value="SIRPLUS"></option>
                                        <option value="SPIRONOLACTON 100"></option>
                                        <option value="SPIRONOLACTON 25"></option>
                                        <option value="SUCRALFATE TAB"></option>
                                        <option value="TABLET TAMBAH DARAH"></option>
                                        <option value="TAMSULOSIN 0.4MG"></option>
                                        <option value="THIAMAZOLE 10"></option>
                                        <option value="TRAMADOL"></option>
                                        <option value="TRANEXAMIC ACID 500MG"></option>
                                        <option value="TRIHEXSIFENIDIL"></option>
                                        <option value="URSODEOXYCHOLIC ACID"></option>
                                        <option value="VALSARTAN 160"></option>
                                        <option value="VALSARTAN 80"></option>
                                        <option value="VIT B COMPLEKS"></option>
                                        <option value="VIT B KOMPLEKS"></option>
                                        <option value="VIT B1"></option>
                                        <option value="VIT B6"></option>
                                        <option value="VIT B12"></option>
                                        <option value="VIT B12"></option>
                                        <option value="VIT C IPI"></option>
                                        <option value="VIT K"></option>
                                        <option value="WARFARIN 2MG"></option>
                                        <option value="ZINC"></option>
                                        <option value="CENDO FLOXA"></option>
                                        <option value="CENDO XITROL"></option>
                                        <option value="OTILON"></option>
                                        <option value="POLIDEMISIN"></option>
                                        <option value="NELICORT"></option>
                                        <option value="ERLAMICETYN SALEP MATA"></option>
                                        <option value="ERLAMICETYN TM"></option>
                                        <option value="FORUMEN TT"></option>
                                        <option value="ALKOHOL 70%"></option>
                                        <option value="BETADINE 1L"></option>
                                        <option value="BETADINE 30ML"></option>
                                        <option value="CLORINE"></option>
                                        <option value="GLYCERIN"></option>
                                        <option value="H2O2"></option>
                                        <option value="OCTENIC SPRAY"></option>
                                        <option value="RIVANOL 300ML"></option>
                                        <option value="RIVANOL 100ML"></option>
                                        <option value="AMBROXOL SYR"></option>
                                        <option value="AMOXICILLIN"></option>
                                        <option value="ANTASIDA SYRUP"></option>
                                        <option value="APIALS DROP"></option>
                                        <option value="APIALYS SYRUP"></option>
                                        <option value="BACTROPIM COMBI"></option>
                                        <option value="BHIOTICOL"></option>
                                        <option value="CAZETIN COMBI"></option>
                                        <option value="CEFADROXIL"></option>
                                        <option value="CEFIXIM"></option>
                                        <option value="CETIRIZINE"></option>
                                        <option value="COMTUSI"></option>
                                        <option value="CURCUMA SYRUP"></option>
                                        <option value="DHIANICOL"></option>
                                        <option value="DOMPERIDONE"></option>
                                        <option value="FARIZOL"></option>
                                        <option value="FARSIFEN"></option>
                                        <option value="FASGO FORTE"></option>
                                        <option value="FEBRYN"></option>
                                        <option value="FERIS SYR"></option>
                                        <option value="FERIZ DROP"></option>
                                        <option value="GUANISTREP"></option>
                                        <option value="HECOSAN"></option>
                                        <option value="HELXIM"></option>
                                        <option value="HUFAMICETIN SYRUP"></option>
                                        <option value="IMBOOST KIDS"></option>
                                        <option value="IMUNOS"></option>
                                        <option value="KIDYVIT"></option>
                                        <option value="KITAVIT SYR"></option>
                                        <option value="LACTULOSE"></option>
                                        <option value="LASAL EXPECTORAN"></option>
                                        <option value="LASAL SYR"></option>
                                        <option value="LECOZINC DROP"></option>
                                        <option value="LERZIN"></option>
                                        <option value="LIKURMIN"></option>
                                        <option value="LOSTACEF"></option>
                                        <option value="METRONIDAZOLE SYRUP"></option>
                                        <option value="MUCOS DROP"></option>
                                        <option value="MUCOS SYRUP"></option>
                                        <option value="MUCOTEIN"></option>
                                        <option value="NYSTATIN DROP"></option>
                                        <option value="OBH SYRUP"></option>
                                        <option value="OPIDIAR"></option>
                                        <option value="OPILAX"></option>
                                        <option value="OTTOPAN DROP"></option>
                                        <option value="OTTOPAN SYR"></option>
                                        <option value="PARACETAMOL DROP"></option>
                                        <option value="PARACETAMOL SYRUP"></option>
                                        <option value="PSIDII SYRUP"></option>
                                        <option value="RHINOS JUNIOR"></option>
                                        <option value="RHINOS NEO"></option>
                                        <option value="SAMMOXIN"></option>
                                        <option value="SODIUM VALPROAT"></option>
                                        <option value="SUCRALFAT SYR"></option>
                                        <option value="VALEPSSY SYR"></option>
                                        <option value="VESPERUM DROP"></option>
                                        <option value="VESPERUM SYRUP"></option>
                                        <option value="ZEMOXIN"></option>
                                        <option value="ZINC DROP"></option>
                                        <option value="ZINC SYRUP"></option>
                                        <option value="ADONA (CARBAMAZOCHROME)"></option>
                                        <option value="AMINOPHYLIN"></option>
                                        <option value="AMIODARONE/TYARID"></option>
                                        <option value="AMPICILIN"></option>
                                        <option value="ASAM TRANEXAMAT 500 MG"></option>
                                        <option value="ATROPINE SULFAT"></option>
                                        <option value="ATROPINE SULFAT"></option>
                                        <option value="BIOSAT ATS"></option>
                                        <option value="BUCAIN"></option>
                                        <option value="CALCI GLUCONAS"></option>
                                        <option value="CARBAMAZOCHROME"></option>
                                        <option value="CEFAZOLIN"></option>
                                        <option value="CEFAZOLIN"></option>
                                        <option value="CEFOTAXIME"></option>
                                        <option value="CEFOTAXIME"></option>
                                        <option value="CEFTAZIDIM"></option>
                                        <option value="CEFTAZIDIM"></option>
                                        <option value="CEFTRIAXONE"></option>
                                        <option value="CEFTRIAXONE"></option>
                                        <option value="CEFTRIAXONE"></option>
                                        <option value="CEFTRIAXONE"></option>
                                        <option value="CEFTRIAXONE"></option>
                                        <option value="CEPEZET"></option>
                                        <option value="CITICOLIN 500 MG"></option>
                                        <option value="CITICOLIN 500 MG"></option>
                                        <option value="COLSANCETIN"></option>
                                        <option value="COLSANCETIN"></option>
                                        <option value="COMBIVENT"></option>
                                        <option value="CYLCOFEM"></option>
                                        <option value="DEXAMETASHON"></option>
                                        <option value="DEXAMETASHON"></option>
                                        <option value="DEXKETOPROFEN"></option>
                                        <option value="DIPENHIDRAMIN"></option>
                                        <option value="DOBUTAMIN"></option>
                                        <option value="DOPAMIN"></option>
                                        <option value="EPHEDRINE"></option>
                                        <option value="EPHINEPRINE"></option>
                                        <option value="EPHINEPRINE"></option>
                                        <option value="FARGOXIN"></option>
                                        <option value="FUROSEMIDE"></option>
                                        <option value="FUROSEMIDE"></option>
                                        <option value="FUROSEMIDE"></option>
                                        <option value="HEPARIN"></option>
                                        <option value="HUMALOG MIX 100"></option>
                                        <option value="HUMALOG MIX 50"></option>
                                        <option value="HYOSCINE"></option>
                                        <option value="HYOSCINE"></option>
                                        <option value="INDUXIN"></option>
                                        <option value="INVICLOT"></option>
                                        <option value="KETAMIN"></option>
                                        <option value="KETOROLAC 30 MG"></option>
                                        <option value="KETOROLAC 30 MG"></option>
                                        <option value="LEVEMIR"></option>
                                        <option value="LIDOCAIN 2%"></option>
                                        <option value="LIDODEX"></option>
                                        <option value="MECOBALAMIN"></option>
                                        <option value="MECOBALAMIN"></option>
                                        <option value="MECOBALAMIN"></option>
                                        <option value="MEROPENEM"></option>
                                        <option value="METHYLPREDNISOLON 125 MG"></option>
                                        <option value="METHYLPREDNISOLON 125 MG"></option>
                                        <option value="METHYLERGOMETRINE"></option>
                                        <option value="MYOTONIC"></option>
                                        <option value="NEUROSANBE"></option>
                                        <option value="NICARDIPIN"></option>
                                        <option value="NOREPINEPHRIE"></option>
                                        <option value="NOREPINEPRINE"></option>
                                        <option value="NOVOMIX"></option>
                                        <option value="NOVORAPID"></option>
                                        <option value="NTG"></option>
                                        <option value="NTG"></option>
                                        <option value="OMEPRAZOLE"></option>
                                        <option value="ONDANCETRON 4 MG"></option>
                                        <option value="OXYTOCIN"></option>
                                        <option value="PEHACAIN"></option>
                                        <option value="PHENYTOIN"></option>
                                        <option value="PHYTOMENADION"></option>
                                        <option value="PROPOFOL"></option>
                                        <option value="PULMICORT"></option>
                                        <option value="SAKORBIN"></option>
                                        <option value="SANSULIN"></option>
                                        <option value="SIKZONOATE"></option>
                                        <option value="SPASHI"></option>
                                        <option value="SOTATIC/HYOSCIN"></option>
                                        <option value="TIARTY"></option>
                                        <option value="TRAMADOL"></option>
                                        <option value="TRAMADOL"></option>
                                        <option value="TRANEXAMID ACID"></option>
                                        <option value="VASOLA"></option>
                                        <option value="VIT K"></option>
                                        <option value="LODOMER"></option>
                                        <option value="RANITIDIN"></option>
                                        <option value="SOLVINEX"></option>
                                        <option value="TRICLOFEM"></option>
                                        <option value="TRIAMCINOLON"></option>
                                        <option value="FONDAPARINUX"></option>
                                        <option value="HYDROCORTISONE"></option>
                                        <option value="AQUA BIDEST 1000ML"></option>
                                        <option value="AQUADES 20ML"></option>
                                        <option value="CIPROFLOXACIN 200 MG"></option>
                                        <option value="D10%"></option>
                                        <option value="D5%"></option>
                                        <option value="FUTROLIT"></option>
                                        <option value="INFIMICIN"></option>
                                        <option value="KCL"></option>
                                        <option value="LEVOFLOXACIN 500MG"></option>
                                        <option value="LEVOFLOXACIN 750MG"></option>
                                        <option value="M20"></option>
                                        <option value="METRONIDAZOLE 500 MG"></option>
                                        <option value="MGSO4 20%"></option>
                                        <option value="MGSO4 20%"></option>
                                        <option value="MGSO4 40%"></option>
                                        <option value="MGSO4 40%"></option>
                                        <option value="MYLON"></option>
                                        <option value="NACL 100 ML"></option>
                                        <option value="NACL 500 ML"></option>
                                        <option value="PARACETAMOL INFUS"></option>
                                        <option value="RESFAR"></option>
                                        <option value="RESFAR"></option>
                                        <option value="RING-AS"></option>
                                        <option value="RING AS"></option>
                                        <option value="RINGERFUNDING"></option>
                                        <option value="RINGERLACTAT"></option>
                                        <option value="RL"></option>
                                        <option value="SANBE HEST"></option>
                                        <option value="TRIDEX 27B"></option>
                                        <option value="WATER FOR INJ 500"></option>
                                        <option value="WATER FOR IRIGATION 1 L"></option>
                                        <option value="ZISTIC"></option>
                                        <option value="KA-EN 3B"></option>
                                        <option value="STESOLID RECTAL"></option>
                                        <option value="FENTANYL INJEKSI"></option>
                                        <option value="MORFINA INJEKSI"></option>
                                        <option value="SEDACUM (MIDAZOLAM)"></option>
                                        <option value="SIBITAL INJEKSI"></option>
                                        <option value="VALISANBE INJEKSI"></option>
                                        <option value="ALPRAZOLAM 0,5"></option>
                                        <option value="ALTARAX 1 (ALPRAZOLAM 1MG)"></option>
                                        <option value="ANALSIK"></option>
                                        <option value="BRAXIDIN"></option>
                                        <option value="CLOBAZAM 10MG"></option>
                                        <option value="CLONAZEPAM"></option>
                                        <option value="CODEINE"></option>
                                        <option value="MELIDOX"></option>
                                        <option value="MST CONTINUS"></option>
                                        <option value="SIBITAL 50 MG"></option>
                                        <option value="VALISANBE 5 MG"></option>
                                        <option value="ALYRENOL"></option>
                                        <option value="ADALAT OROS"></option>
                                        <option value="AKITA"></option>
                                        <option value="AMINEVRON"></option>
                                        <option value="AMINORAL"></option>
                                        <option value="ANALTRAM"></option>
                                        <option value="ARCAPEC"></option>
                                        <option value="ARIPRIPAZOL"></option>
                                        <option value="ASAM FOLAT"></option>
                                        <option value="ASMEF"></option>
                                        <option value="ASPAR K"></option>
                                        <option value="ASPILET"></option>
                                        <option value="ASTIKA"></option>
                                        <option value="BECOM C"></option>
                                        <option value="BECOM-ZET"></option>
                                        <option value="BAMGETOL 200 MG"></option>
                                        <option value="BERLIMOX"></option>
                                        <option value="BIO ATP"></option>
                                        <option value="BIOLECTA"></option>
                                        <option value="BLEDSTOP"></option>
                                        <option value="BRONSOLVAN"></option>
                                        <option value="CAL 95"></option>
                                        <option value="CALCIFAR"></option>
                                        <option value="CALCIFAR"></option>
                                        <option value="CALCIDIN"></option>
                                        <option value="CALITOZ"></option>
                                        <option value="CALITOZ"></option>
                                        <option value="CALREN"></option>
                                        <option value="CATAFLAM"></option>
                                        <option value="CAVIPLEX"></option>
                                        <option value="CAVIPLEX CDEZ"></option>
                                        <option value="COBAZIM 1000"></option>
                                        <option value="COBAZIM 3000"></option>
                                        <option value="CURCUMA FORCE"></option>
                                        <option value="CURLIV PLUS"></option>
                                        <option value="DEPAKOTE"></option>
                                        <option value="DEXAHARSEN 0,5MG"></option>
                                        <option value="DIANICOL"></option>
                                        <option value="DIFLAM"></option>
                                        <option value="DOPAMET"></option>
                                        <option value="DULCOLAX 10"></option>
                                        <option value="EPERINOC"></option>
                                        <option value="EPEXOL"></option>
                                        <option value="ERPHAFILIN"></option>
                                        <option value="ERPHAFILIN"></option>
                                        <option value="ERYSANBE"></option>
                                        <option value="ESFOLAT"></option>
                                        <option value="ESTHERO"></option>
                                        <option value="EUTHYROX 50"></option>
                                        <option value="FARGOXIN"></option>
                                        <option value="ETABION"></option>
                                        <option value="FOLAC"></option>
                                        <option value="GLAUSETA"></option>
                                        <option value="FARMASAL"></option>
                                        <option value="FASIDOL FORTE"></option>
                                        <option value="FASORBID"></option>
                                        <option value="FENOLIP 160"></option>
                                        <option value="FERITRIN"></option>
                                        <option value="FERO PLUS"></option>
                                        <option value="FG THROCES"></option>
                                        <option value="FLUGO"></option>
                                        <option value="FLUMIN"></option>
                                        <option value="FOLAMIL GENIO"></option>
                                        <option value="FOLAVIT"></option>
                                        <option value="FONDAZEN"></option>
                                        <option value="FONYLIN MR"></option>
                                        <option value="FORMOM"></option>
                                        <option value="HEPTASAN"></option>
                                        <option value="HERBEZER 100 MG"></option>
                                        <option value="HERBEZER 100 MG"></option>
                                        <option value="HERBEZER 200 MG"></option>
                                        <option value="HERBEZER 200 MG"></option>
                                        <option value="HEXIMER 2MG"></option>
                                        <option value="HYSTOLAN"></option>
                                        <option value="IMBOOST"></option>
                                        <option value="IMUNOS"></option>
                                        <option value="INAMID"></option>
                                        <option value="INTUNAL F"></option>
                                        <option value="ITAMOL FORTE"></option>
                                        <option value="KALITAKE"></option>
                                        <option value="KALXETIN 10"></option>
                                        <option value="KENDARON"></option>
                                        <option value="KSR"></option>
                                        <option value="LABUMIN"></option>
                                        <option value="LACIDOFIL CAP"></option>
                                        <option value="LACIDOFIL SCH"></option>
                                        <option value="LIBROCEF"></option>
                                        <option value="LAFLANAC"></option>
                                        <option value="LAMESON 16"></option>
                                        <option value="LAMESON 4"></option>
                                        <option value="LAMESON 8"></option>
                                        <option value="LAMICTAL"></option>
                                        <option value="LAPISTAN 500MG"></option>
                                        <option value="LEVOPAR"></option>
                                        <option value="LESHICOL"></option>
                                        <option value="LIBROCEF"></option>
                                        <option value="LICO C500"></option>
                                        <option value="LICOKALK"></option>
                                        <option value="LIVRON B PLEK"></option>
                                        <option value="MICROGEST 100MG"></option>
                                        <option value="MICROGEST 200MG"></option>
                                        <option value="MINIASPI"></option>
                                        <option value="MYOTONIC"></option>
                                        <option value="NEURODEX"></option>
                                        <option value="NEUROSANBE"></option>
                                        <option value="NITROKAF"></option>
                                        <option value="NONEMI"></option>
                                        <option value="NOSPRINOL"></option>
                                        <option value="NOPROSTOL"></option>
                                        <option value="NORELUT"></option>
                                        <option value="NORIT"></option>
                                        <option value="NUCRAL"></option>
                                        <option value="OMEGDIAR"></option>
                                        <option value="ORBUMIN"></option>
                                        <option value="ORIGINAL E"></option>
                                        <option value="PEHAVRAL"></option>
                                        <option value="PHYTOMENADION"></option>
                                        <option value="PIRALEN"></option>
                                        <option value="PLETAAL SR"></option>
                                        <option value="PROFERTIL"></option>
                                        <option value="PROMAVIT"></option>
                                        <option value="PSIDII"></option>
                                        <option value="Q FOLIC"></option>
                                        <option value="RECALLUS / CYSTON"></option>
                                        <option value="RECOLFAR"></option>
                                        <option value="RECOVER"></option>
                                        <option value="REDACID"></option>
                                        <option value="RENADINAC"></option>
                                        <option value="RETHAPYL"></option>
                                        <option value="SAMSCA"></option>
                                        <option value="SCOPMA"></option>
                                        <option value="SCOPMA PLUS"></option>
                                        <option value="SINOCOIT"></option>
                                        <option value="SISTENOL"></option>
                                        <option value="SPASMINAL"></option>
                                        <option value="STIMUNO PLUS"></option>
                                        <option value="STINOPI"></option>
                                        <option value="SULFITIS"></option>
                                        <option value="SMARC 2 MG"></option>
                                        <option value="TEOSAL"></option>
                                        <option value="THIAMPLEX"></option>
                                        <option value="TIAVELL"></option>
                                        <option value="TIAVELL"></option>
                                        <option value="TRIDE"></option>
                                        <option value="URINTER"></option>
                                        <option value="VBLOC"></option>
                                        <option value="VELVED"></option>
                                        <option value="VENOSMIL"></option>
                                        <option value="VIT B1"></option>
                                        <option value="VIT C IPI"></option>
                                        <option value="VIT D 1000"></option>
                                        <option value="VITZYM PLUS"></option>
                                        <option value="VOSEA"></option>
                                        <option value="ZEGREN"></option>
                                        <option value="YUSIMOX"></option>
                                        <option value="OMEDRINAT"></option>
                                        <option value="SANMOL"></option>
                                        <option value="TREMENSA"></option>
                                        <option value="ACYCLOVIR CR"></option>
                                        <option value="BETADIN GARGLE"></option>
                                        <option value="BETADIN SABUN CAIR"></option>
                                        <option value="BETASONE N"></option>
                                        <option value="BIOPLACENTON"></option>
                                        <option value="CALADIN TALK"></option>
                                        <option value="CALADINE LOTION"></option>
                                        <option value="CINOLON"></option>
                                        <option value="DESOXIMETHASONE"></option>
                                        <option value="DIKLOFENAK DIETHYLAMI"></option>
                                        <option value="GENTAMICIN"></option>
                                        <option value="HYDROCORTISONE 2.5%"></option>
                                        <option value="KETOCONAZOLE"></option>
                                        <option value="MICONAZOLE"></option>
                                        <option value="OCTEDIN"></option>
                                        <option value="PERMETRIN"></option>
                                        <option value="PRONTOSON GEL"></option>
                                        <option value="SULFADIAZIN"></option>
                                        <option value="SALICYL TALK"></option>
                                        <option value="SCABIMITE"></option>
                                        <option value="TROMBOPOP GEL"></option>
                                        <option value="VENOSMIL"></option>
                                        <option value="ZOLAGEL"></option>
                                        <option value="PULMICORT"></option>
                                        <option value="SERETIDE DISKUS"></option>
                                        <option value="SERETIDE INHALER"></option>
                                        <option value="BUDESMA"></option>
                                        <option value="COMBIVENT"></option>
                                        <option value="VENTOLIN"></option>

                                    </datalist>
                                </div>
                            </div>
                        </div>
                        <script>
                            function updateTotals() {
                                const obatInputs = document.querySelectorAll('[name="nama_obat[]"]');
                                let totalObatFornas = 0;
                                let totalItem = 0;

                                obatInputs.forEach((input) => {
                                    if (input.value) {
                                        // Check if the input value matches any of the Fornas obat
                                        const fornasObat = [
                                        "FENTANYL",
                                        "KODEIN",
                                        "MORFIN",
                                        "PETIDIN ",
                                        "ASAM MEFENAMAT",
                                        "KETOROLAC",
                                        "METAMIZOL",
                                        "NATRIUM DIKLOFENAK",
                                        "CELEKOKSIB",
                                        "KOLKISIN",
                                        "AMITRIPTILIN",
                                        "GABAPENTIN",
                                        "CARBAMAZEPIN",
                                        "PREGABALIN",
                                        "BUPIVAKAIN",
                                        "BUPIVAKAIN HEAVY (SPINAL)",
                                        "ETIL KLORIDA",
                                        "LIDOKAIN",
                                        "ISOFLURAN",
                                        "KETAMIN",
                                        "OKSIGEN",
                                        "PROPOFOL",
                                        "ATROPIN",
                                        "DIAZEPAM",
                                        "MIDAZOLAM",
                                        "DEKSAMETASON ",
                                        "DIFENHIDRAMIN",
                                        "EPINEFRIN",
                                        "LORATADIN",
                                        "ATROPIN",
                                        "CALCIUM GLUKONAT",
                                        "NEOSTIGMIN",
                                        "CARBAMAZEPIN",
                                        "CLONAZEPAM",
                                        "LAMOTIGRIN",
                                        "MAGNESIUM SULFAT",
                                        "PIRANTEL PAMOAT",
                                        "AMPICILIN",
                                        "CEFAZOLIN",
                                        "CEFOTAXIM",
                                        "CEFTAZIDIM",
                                        "CEFTRIAXON",
                                        "KLORAMFENIKOL",
                                        "ETRITROMISIN",
                                        "GENTAMISIN",
                                        "CLINDAMICIN",
                                        "MEROPENEM",
                                        "RIFAMPISIN",
                                        "ISONIAZID",
                                        "OAT KDT KATEGORI 1",
                                        "RIFAMPISIN",
                                        "ISONIAZIDE" ,
                                        "PIRAZINAMIDE" ,
                                        "ETAMBUTOL",
                                        "RIFAMPISIN",
                                        "ISONIAZIDE ",
                                        "RIFAPENTIN (PENCEGAHAN TB)",
                                        "ASAM PIPEMIDAT",
                                        "FLUKONAZOL",
                                        "GRISEOFULVIN",
                                        "KETOKONAZOL",
                                        "NYSTATIN",
                                        "METRONIDAZOL",
                                        "ASIKLOVIR",
                                        "PROPANOLOL",
                                        "VALPROAT",
                                        "BETAHISTIN",
                                        "TRIHEXYPHENIDIL",
                                        "ASAM FOLAT",
                                        "SIANOKOBALAMIN (VITAMIN B 12)",
                                        "FONDAPARINUX",
                                        "HEPARIN",
                                        "WARFARIN",
                                        "TIBERKULIN PROTEIN PURIFIED DERIVATIVE (PPD)/MANTOUX",
                                        "HIDROGEN PEROKSIDA",
                                        "CHLORHEXIDINE",
                                        "POVIDON IODINE",
                                        "ETANOL",
                                        "EUGENOL",
                                        "FORMOKRESOL",
                                        "KALSIUM HIDROKSIDA",
                                        "KLORFENOL KAMFER MENTOL (CHKM)",
                                        "CHLORHEXIDINE",
                                        "PASTA PENGISI SALURAN AKAR",
                                        "POVIDONE IODIN",
                                        "NYSTATIN",
                                        "HIDROKLOROTIAZIDE",
                                        "MANITOL",
                                        "SPIRONOLAKTON",
                                        "TAMSULOSIN",
                                        "ACARBOSA",
                                        "GLIBENKLAMID",
                                        "GLICLAZIDE",
                                        "GLIQUIDON",
                                        "GLIMEPIRIDE",
                                        "METFORMIN",
                                        "PIOGLITAZON",
                                        "INSULIN DETEMIR (LEVEMIR)",
                                        "INSULIN GLARGINE (LANTUS)",
                                        "INSULIN LISPRO (HUMALOG MIX 50)",
                                        "INSULIN ASPART (NOVORAPID)",
                                        "INSULIN GLUISIN (APIDRA)",
                                        "KOMBINASI 70% INSULIN PROTAMINE ASPART : 30% INSULIN ASPART (NOVOMIX)",
                                        "KOMBINASI 50% INSULIN PROTAMINE LISPRO ; 50% INSULIN LISPRO (HUMALOG MIX 50)",
                                        "CO-FORMULATION 70% INSULIN DEGLUDEC (ULTRA-LONG ACTING) : 30% INSULIN ASPART) (RYZODEG)",
                                        "IUD LEVONOGESTREL",
                                        "LEVONOGESTREL",
                                        "BROMOKRIPTIN",
                                        "LEVOTIROKSIN",
                                        "PROPILTIOURASIL",
                                        "TIAMAZOL",
                                        "HIDROKORTISON",
                                        "PREDNISON",
                                        "TRIAMCINOLON ACETONID",
                                        "AMLODIPIN",
                                        "DILTIAZEM",
                                        "GLISERIL TRINITRAT",
                                        "ISOSORBID DINITRAT",
                                        "LIDOKAIN",
                                        "PROPANOLOL",
                                        "VERAPAMIL",
                                        "AMLODIPIN",
                                        "BISOPROLOL",
                                        "DILTIAZEM",
                                        "HIDROKLOROTIAZIDE",
                                        "IRBESARTAN",
                                        "CANDESARTAN",
                                        "CAPTOPRIL",
                                        "CLONIDIN",
                                        "LISINOPRIL ",
                                        "METILDOPA",
                                        "NIFEDIPIN",
                                        "NIKARDIPIN",
                                        "RAMIPRIL",
                                        "VALSARTAN",
                                        "VERAPAMIL",
                                        "SILDENAFIL",
                                        "ASAM ASETILSALISILAT (ASETOSAL)",
                                        "CLOPIDOGREL",
                                        "CILOSTAZOL",
                                        "BISOPROLOL",
                                        "CANDESARTAN",
                                        "CAPTOPRIL",
                                        "CARVEDILOL (VBLOC) ",
                                        "RAMIPRIL",
                                        "SPIRONOLAKTON",
                                        "DOBUTAMIN",
                                        "DOPAMIN",
                                        "EPINEFRIN",
                                        "NOREPINEPRIN",
                                        "ATORVASTATIN",
                                        "FENOFIBRAT",
                                        "GEMFIBROZIL",
                                        "SIMVASTATIN",
                                        "EFEDRIN",
                                        "NATRIUM FUSIDAT",
                                        "SILVER SULFADIAZIN",
                                        "KETOKONAZOL",
                                        "MIKONAZOL",
                                        "NYSTATIN",
                                        "HIDROKORTISON",
                                        "PERMETRIN",
                                        "BEDAK SALISIL",
                                        "KALAMIN",
                                        "TRIAMCINOLON ACETONID",
                                        "ORALIT",
                                        "KALIUM KLORIDA (KSR)",
                                        "NATRIUM BIKARBONAT",
                                        "ZINC",
                                        "AIR STERIL UNTUK INJEKSI",
                                        "AIR UNTUK IRIGASI",
                                        "MANITOL",
                                        "MANITOL",
                                        "ASIKLOVIR",
                                        "LEVOFLOXACIN",
                                        "TOBRAMISIN",
                                        "ATROPIN",
                                        "ASETAZOLAMID",
                                        "TIMOLOL",
                                        "ALPRAZOLAM",
                                        "CLOBAZAM",
                                        "AMITRIPTILIN",
                                        "FLUOXETIN",
                                        "FLUOXETIN",
                                        "HALOPERIDOL",
                                        "KLORPROMAZIN",
                                        "VALPROAT",
                                        "ATRAKURIUM",
                                        "ROKURONIUM",
                                        "NEOSTIGMIN",
                                        "NEOSTIGMIN",
                                        "DIMENHIDRINAT",
                                        "DOMPERIDON",
                                        "CHLORPROMAZIN",
                                        "ATROPIN",
                                        "KAOLIN+PECTIN (OMEGDIAR)",
                                        "LOPERAMID",
                                        "GLISEROL",
                                        "LAKTULOSA",
                                        "ASAM URSODEOKSICHOLIC (UDCA)",
                                        "AMINOFILIN",
                                        "BUDESONIDE",
                                        "EPINEFRIN",
                                        "FLUTICASON ",
                                        "SALMETEROL+FLUTIKASON (SERETIDE)",
                                        "IPRATROPIUM BROMIDA+SALBUTAMOL (RESPIVENT)",
                                        "PREDNISON",
                                        "TEOFILIN",
                                        "CODEIN",
                                        "ACETYLSISTEIN",
                                        "BUDESONIDE",
                                        "IPRATROPIUM BROMIDA+SALBUTAMOL (RESPIVENT)",
                                        "SALMETEROL+FLUTIKASON (SERETIDE)",
                                        "HEPATITIS B IMUNOGLOBULIN (HUMAN)",
                                        "SERUM ANTITETANUS (A.T.S)",
                                        "VAKSIN BCG",
                                        "VAKSIN COVID-19",
                                        "VAKSIN DPT-GB-Hib",
                                        "VAKSIN HB0",
                                        "VAKSIN HUMAN ROTAVIRUS",
                                        "VAKSIN DPT-GB-Hib",
                                        "VAKSIN MMR",
                                        "VAKSIN POLIO ORAL",
                                        "HIDROGEN PEROKSIDA",
                                        "KLORAMFENIKOL",
                                        "ASAM ASKORBAT (VITAMIN C)",
                                        "CALSIUM GLUKONAT",
                                        "KALSIUM LAKTAT (KALK)",
                                        "PIRIDOKSIN (VITAMIN B6)",
                                        "SIANOKOBALAMIN (VITAMIN B 12)",
                                        "TIAMIN (VITAMIN B 1)",
                                        "VITAMIN B KOMPLEKS",
                                        "SODIUM HYALURONAT (UMARONE)",
                                        ];
                                        if (fornasObat.includes(input.value.toUpperCase())) {
                                            totalObatFornas += 1; // Increment for each selected Fornas obat
                                        }
                                        totalItem += 1; // Increment for each selected obat
                                    }
                                });

                                document.getElementById('total_obat_fornas').value = totalObatFornas;
                                document.getElementById('total_item').value = totalItem;
                            }
                        </script>
                        <!-- Tombol-tombol -->
                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i> SIMPAN</button>
                        <button class="btn btn-light" type="button" id="add-obat-button">Tambah Obat</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>
                    </form>
                    <script src="{{ asset('js/custom.js') }}"></script>
                </div>
                {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
                <script>
                    $(document).ready(function() {
                        $('#nama_obat').autocomplete({
                            source: '/autocomplete/nama_obat', // URL route yang telah Anda buat
                            minLength: 2 // Minimal karakter sebelum autocomplete aktif
                        });
                    });
                </script> --}}
            </div>
        </div>
    </section>
</div>

@stop
