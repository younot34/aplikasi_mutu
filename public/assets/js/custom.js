/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

document.addEventListener('DOMContentLoaded', function() {
    // Event listener untuk tombol tambah obat
    const addObatButton = document.getElementById('add-obat-button');
    if (addObatButton) {
        addObatButton.addEventListener('click', function() {
            var container = document.getElementById('obat-container');
            var newRow = document.createElement('div');
            newRow.className = 'form-row';
            newRow.innerHTML = `

                <div class="form-group col-md-3 ">
                    <label>R/</label>
                    <input type="number" name="r[]" class="form-control">
                </div>

                <div class="form-group col-md-3">
                                    <label>Nama Obat</label>
                                    <input type="text" name="nama_obat[]" class="form-control" list="obat_list" onchange="updateTotals()">
                                    <datalist id="obat_list">
                                        <option value="FENTANYL"></option>
                                        <option value="KODEIN"></option>
                                        <option value="MORFIN"></option>
                                        <option value="PETIDIN "></option>
                                        <option value="ASAM MEFENAMAT"></option>
                                        <option value="KETOROLAC"></option>
                                        <option value="METAMIZOL"></option>
                                        <option value="NATRIUM DIKLOFENAK"></option>
                                        <option value="CELEKOKSIB"></option>
                                        <option value="KOLKISIN"></option>
                                        <option value="AMITRIPTILIN"></option>
                                        <option value="GABAPENTIN"></option>
                                        <option value="CARBAMAZEPIN"></option>
                                        <option value="PREGABALIN"></option>
                                        <option value="BUPIVAKAIN"></option>
                                        <option value="BUPIVAKAIN HEAVY (SPINAL)"></option>
                                        <option value="ETIL KLORIDA"></option>
                                        <option value="LIDOKAIN"></option>
                                        <option value="ISOFLURAN"></option>
                                        <option value="KETAMIN"></option>
                                        <option value="OKSIGEN"></option>
                                        <option value="PROPOFOL"></option>
                                        <option value="ATROPIN"></option>
                                        <option value="DIAZEPAM"></option>
                                        <option value="MIDAZOLAM"></option>
                                        <option value="DEKSAMETASON "></option>
                                        <option value="DIFENHIDRAMIN"></option>
                                        <option value="EPINEFRIN"></option>
                                        <option value="LORATADIN"></option>
                                        <option value="ATROPIN"></option>
                                        <option value="CALCIUM GLUKONAT"></option>
                                        <option value="NEOSTIGMIN"></option>
                                        <option value="CARBAMAZEPIN"></option>
                                        <option value="CLONAZEPAM"></option>
                                        <option value="LAMOTIGRIN"></option>
                                        <option value="MAGNESIUM SULFAT"></option>
                                        <option value="PIRANTEL PAMOAT"></option>
                                        <option value="AMPICILIN"></option>
                                        <option value="CEFAZOLIN"></option>
                                        <option value="CEFOTAXIM"></option>
                                        <option value="CEFTAZIDIM"></option>
                                        <option value="CEFTRIAXON"></option>
                                        <option value="KLORAMFENIKOL"></option>
                                        <option value="ETRITROMISIN"></option>
                                        <option value="GENTAMISIN"></option>
                                        <option value="CLINDAMICIN"></option>
                                        <option value="MEROPENEM"></option>
                                        <option value="RIFAMPISIN"></option>
                                        <option value="ISONIAZID"></option>
                                        <option value="OAT KDT KATEGORI 1"></option>
                                        <option value="4 KDT/FDC -> RIFAMPISIN ; ISONIAZIDE ; PIRAZINAMIDE ; ETAMBUTOL"></option>
                                        <option value="2 KDT/FDC -> RIFAMPISIN ; ISONIAZIDE "></option>
                                        <option value="RIFAPENTIN (PENCEGAHAN TB)"></option>
                                        <option value="ASAM PIPEMIDAT"></option>
                                        <option value="FLUKONAZOL"></option>
                                        <option value="GRISEOFULVIN"></option>
                                        <option value="KETOKONAZOL"></option>
                                        <option value="NYSTATIN"></option>
                                        <option value="METRONIDAZOL"></option>
                                        <option value="ASIKLOVIR"></option>
                                        <option value="PROPANOLOL"></option>
                                        <option value="VALPROAT"></option>
                                        <option value="BETAHISTIN"></option>
                                        <option value="TRIHEXYPHENIDIL"></option>
                                        <option value="ASAM FOLAT"></option>
                                        <option value="SIANOKOBALAMIN (VITAMIN B 12)"></option>
                                        <option value="FONDAPARINUX"></option>
                                        <option value="HEPARIN"></option>
                                        <option value="WARFARIN"></option>
                                        <option value="TIBERKULIN PROTEIN PURIFIED DERIVATIVE (PPD)/MANTOUX"></option>
                                        <option value="HIDROGEN PEROKSIDA"></option>
                                        <option value="CHLORHEXIDINE"></option>
                                        <option value="POVIDON IODINE"></option>
                                        <option value="ETANOL"></option>
                                        <option value="EUGENOL"></option>
                                        <option value="FORMOKRESOL"></option>
                                        <option value="KALSIUM HIDROKSIDA"></option>
                                        <option value="KLORFENOL KAMFER MENTOL (CHKM)"></option>
                                        <option value="CHLORHEXIDINE"></option>
                                        <option value="PASTA PENGISI SALURAN AKAR"></option>
                                        <option value="POVIDONE IODIN"></option>
                                        <option value="NYSTATIN"></option>
                                        <option value="HIDROKLOROTIAZIDE"></option>
                                        <option value="MANITOL"></option>
                                        <option value="SPIRONOLAKTON"></option>
                                        <option value="TAMSULOSIN"></option>
                                        <option value="ACARBOSA"></option>
                                        <option value="GLIBENKLAMID"></option>
                                        <option value="GLICLAZIDE"></option>
                                        <option value="GLIQUIDON"></option>
                                        <option value="GLIMEPIRIDE"></option>
                                        <option value="METFORMIN"></option>
                                        <option value="PIOGLITAZON"></option>
                                        <option value="INSULIN DETEMIR (LEVEMIR)"></option>
                                        <option value="INSULIN GLARGINE (LANTUS)"></option>
                                        <option value="INSULIN LISPRO (HUMALOG MIX 50)"></option>
                                        <option value="INSULIN ASPART (NOVORAPID)"></option>
                                        <option value="INSULIN GLUISIN (APIDRA)"></option>
                                        <option value="KOMBINASI 70% INSULIN PROTAMINE ASPART : 30% INSULIN ASPART (NOVOMIX)"></option>
                                        <option value="KOMBINASI 50% INSULIN PROTAMINE LISPRO ; 50% INSULIN LISPRO (HUMALOG MIX 50)"></option>
                                        <option value="CO-FORMULATION 70% INSULIN DEGLUDEC (ULTRA-LONG ACTING) : 30% INSULIN ASPART) (RYZODEG)"></option>
                                        <option value="IUD LEVONOGESTREL"></option>
                                        <option value="LEVONOGESTREL"></option>
                                        <option value="BROMOKRIPTIN"></option>
                                        <option value="LEVOTIROKSIN"></option>
                                        <option value="PROPILTIOURASIL"></option>
                                        <option value="TIAMAZOL"></option>
                                        <option value="HIDROKORTISON"></option>
                                        <option value="PREDNISON"></option>
                                        <option value="TRIAMCINOLON ACETONID"></option>
                                        <option value="AMLODIPIN"></option>
                                        <option value="DILTIAZEM"></option>
                                        <option value="GLISERIL TRINITRAT"></option>
                                        <option value="ISOSORBID DINITRAT"></option>
                                        <option value="LIDOKAIN"></option>
                                        <option value="PROPANOLOL"></option>
                                        <option value="VERAPAMIL"></option>
                                        <option value="AMLODIPIN"></option>
                                        <option value="BISOPROLOL"></option>
                                        <option value="DILTIAZEM"></option>
                                        <option value="HIDROKLOROTIAZIDE"></option>
                                        <option value="IRBESARTAN"></option>
                                        <option value="CANDESARTAN"></option>
                                        <option value="CAPTOPRIL"></option>
                                        <option value="CLONIDIN"></option>
                                        <option value="LISINOPRIL "></option>
                                        <option value="METILDOPA"></option>
                                        <option value="NIFEDIPIN"></option>
                                        <option value="NIKARDIPIN"></option>
                                        <option value="RAMIPRIL"></option>
                                        <option value="VALSARTAN"></option>
                                        <option value="VERAPAMIL"></option>
                                        <option value="SILDENAFIL"></option>
                                        <option value="ASAM ASETILSALISILAT (ASETOSAL)"></option>
                                        <option value="CLOPIDOGREL"></option>
                                        <option value="CILOSTAZOL"></option>
                                        <option value="BISOPROLOL"></option>
                                        <option value="CANDESARTAN"></option>
                                        <option value="CAPTOPRIL"></option>
                                        <option value="CARVEDILOL (VBLOC) "></option>
                                        <option value="RAMIPRIL"></option>
                                        <option value="SPIRONOLAKTON"></option>
                                        <option value="DOBUTAMIN"></option>
                                        <option value="DOPAMIN"></option>
                                        <option value="EPINEFRIN"></option>
                                        <option value="NOREPINEPRIN"></option>
                                        <option value="ATORVASTATIN"></option>
                                        <option value="FENOFIBRAT"></option>
                                        <option value="GEMFIBROZIL"></option>
                                        <option value="SIMVASTATIN"></option>
                                        <option value="EFEDRIN"></option>
                                        <option value="NATRIUM FUSIDAT"></option>
                                        <option value="SILVER SULFADIAZIN"></option>
                                        <option value="KETOKONAZOL"></option>
                                        <option value="MIKONAZOL"></option>
                                        <option value="NYSTATIN"></option>
                                        <option value="HIDROKORTISON"></option>
                                        <option value="PERMETRIN"></option>
                                        <option value="BEDAK SALISIL"></option>
                                        <option value="KALAMIN"></option>
                                        <option value="TRIAMCINOLON ACETONID"></option>
                                        <option value="ORALIT"></option>
                                        <option value="KALIUM KLORIDA (KSR)"></option>
                                        <option value="NATRIUM BIKARBONAT"></option>
                                        <option value="ZINC"></option>
                                        <option value="AIR STERIL UNTUK INJEKSI"></option>
                                        <option value="AIR UNTUK IRIGASI"></option>
                                        <option value="MANITOL"></option>
                                        <option value="MANITOL"></option>
                                        <option value="ASIKLOVIR"></option>
                                        <option value="LEVOFLOXACIN"></option>
                                        <option value="TOBRAMISIN"></option>
                                        <option value="ATROPIN"></option>
                                        <option value="ASETAZOLAMID"></option>
                                        <option value="TIMOLOL"></option>
                                        <option value="ALPRAZOLAM"></option>
                                        <option value="CLOBAZAM"></option>
                                        <option value="AMITRIPTILIN"></option>
                                        <option value="FLUOXETIN"></option>
                                        <option value="FLUOXETIN"></option>
                                        <option value="HALOPERIDOL"></option>
                                        <option value="KLORPROMAZIN"></option>
                                        <option value="VALPROAT"></option>
                                        <option value="ATRAKURIUM"></option>
                                        <option value="ROKURONIUM"></option>
                                        <option value="NEOSTIGMIN"></option>
                                        <option value="NEOSTIGMIN"></option>
                                        <option value="DIMENHIDRINAT"></option>
                                        <option value="DOMPERIDON"></option>
                                        <option value="CHLORPROMAZIN"></option>
                                        <option value="ATROPIN"></option>
                                        <option value="KAOLIN+PECTIN (OMEGDIAR)"></option>
                                        <option value="LOPERAMID"></option>
                                        <option value="GLISEROL"></option>
                                        <option value="LAKTULOSA"></option>
                                        <option value="ASAM URSODEOKSICHOLIC (UDCA)"></option>
                                        <option value="AMINOFILIN"></option>
                                        <option value="BUDESONIDE"></option>
                                        <option value="EPINEFRIN"></option>
                                        <option value="FLUTICASON "></option>
                                        <option value="SALMETEROL+FLUTIKASON (SERETIDE)"></option>
                                        <option value="IPRATROPIUM BROMIDA+SALBUTAMOL (RESPIVENT)"></option>
                                        <option value="PREDNISON"></option>
                                        <option value="TEOFILIN"></option>
                                        <option value="CODEIN"></option>
                                        <option value="ACETYLSISTEIN"></option>
                                        <option value="BUDESONIDE"></option>
                                        <option value="IPRATROPIUM BROMIDA+SALBUTAMOL (RESPIVENT)"></option>
                                        <option value="SALMETEROL+FLUTIKASON (SERETIDE)"></option>
                                        <option value="HEPATITIS B IMUNOGLOBULIN (HUMAN)"></option>
                                        <option value="SERUM ANTITETANUS (A.T.S)"></option>
                                        <option value="VAKSIN BCG"></option>
                                        <option value="VAKSIN COVID-19"></option>
                                        <option value="VAKSIN DPT-GB-Hib"></option>
                                        <option value="VAKSIN HB0"></option>
                                        <option value="VAKSIN HUMAN ROTAVIRUS"></option>
                                        <option value="VAKSIN DPT-GB-Hib"></option>
                                        <option value="VAKSIN MMR"></option>
                                        <option value="VAKSIN POLIO ORAL"></option>
                                        <option value="HIDROGEN PEROKSIDA"></option>
                                        <option value="KLORAMFENIKOL"></option>
                                        <option value="ASAM ASKORBAT (VITAMIN C)"></option>
                                        <option value="CALSIUM GLUKONAT"></option>
                                        <option value="KALSIUM LAKTAT (KALK)"></option>
                                        <option value="PIRIDOKSIN (VITAMIN B6)"></option>
                                        <option value="SIANOKOBALAMIN (VITAMIN B 12)"></option>
                                        <option value="TIAMIN (VITAMIN B 1)"></option>
                                        <option value="VITAMIN B KOMPLEKS"></option>
                                        <option value="SODIUM HYALURONAT (UMARONE)"></option>

                                    </datalist>
                                </div>

            `;
            container.appendChild(newRow);
        });
    }

    // Fungsi untuk menghapus baris obat
    window.removeObatRow = function(index) {
        var row = document.getElementById('obat-row-' + index);
        if (row) {
            row.parentNode.removeChild(row);
        }
    };
});

