<?php
    $koneksi = mysqli_connect("localhost","root","","siteko");
    if (!$koneksi) {
        echo "Koneksi Gagal";
    }

    function rupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }

    function tambah($data){
        global $koneksi;

        //upload gambar
        $bukti_pembayaran = upload();
        if(!$bukti_pembayaran){
            return false;
        }

        $kodeBooking = $data['kode_booking'];
        $query = "UPDATE reservasi SET bukti_pembayaran = '$bukti_pembayaran' , status = 'Pending' WHERE kode_booking = '$kodeBooking'";
        mysqli_query($koneksi,$query);

        return mysqli_affected_rows($koneksi);
    }

    function upload(){
        $namaFile = $_FILES['bukti_pembayaran']['name'];
        $ukuranFile = $_FILES['bukti_pembayaran']['size'];
        $error = $_FILES['bukti_pembayaran']['error'];
        $tmpName = $_FILES['bukti_pembayaran']['tmp_name'];

        //cek apakah tidak ada gambar yang diupload
        if($error === 4){
            echo "<script>
                alert('Pilih gambar terlebih dahulu!');
                </script>";
            return false;
        }

        //cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if(!in_array($ekstensiGambar, $ekstensiGambarValid)){
            echo "<script>
                alert('Yang Anda upload bukan gambar!');
                </script>";
            return false;
        }

        //cek jika ukurannya terlalu besar
        if($ukuranFile > 1000000){
            echo "<script>
                alert('Ukuran gambar terlalu besar!');
                </script>";
            return false;
        }

        //lolos pengecekan, gambar siap diupload
        //generate nama bukti_pembayaran baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;

        move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

        return $namaFileBaru;
    }

    function registrasi($data){
        global $koneksi;

        $nama = ($data["name"]);
        $no_hp = ($data["no_hp"]);
        $email = strtolower(stripslashes($data["email"]));
        $password = mysqli_real_escape_string($koneksi, $data["password"]);
        $confirm_password = mysqli_real_escape_string($koneksi, $data["confirm_password"]);

        //cek email sudah ada atau belum
        $result = mysqli_query($koneksi, "SELECT email FROM user WHERE email = '$email'");

        if(mysqli_fetch_assoc($result)){
            echo "<script>
                    alert('Email sudah terdaftar!'
                  </script>";
            return false;
        }

        //cek konfirmasi password
        if($password !== $confirm_password){
            echo "<script>
                    alert('Konfirmasi password tidak sesuai!');
                  </script>";
            return false;
        }

        //tambahkan userbaru ke database
        mysqli_query($koneksi, "INSERT INTO user VALUES('', '$nama', '$no_hp', '$email', '$password', 'Customer')");

        return mysqli_affected_rows($koneksi);

    }
?>