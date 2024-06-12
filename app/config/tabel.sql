/* 
	INTEGER: Tipe data untuk menyimpan bilangan bulat. Contoh: INTEGER, INT, SMALLINT, BIGINT.
	FLOAT/DOUBLE: Tipe data untuk menyimpan bilangan pecahan (desimal). Contoh: FLOAT, DOUBLE, DECIMAL.
	CHAR/VARCHAR: Tipe data untuk menyimpan string. CHAR memiliki panjang tetap, sedangkan VARCHAR memiliki panjang variabel. Contoh: CHAR(10), VARCHAR(255).
	TEXT: Tipe data untuk menyimpan teks panjang. Contoh: TEXT, LONGTEXT, MEDIUMTEXT.
	DATE/DATETIME/TIMESTAMP: Tipe data untuk menyimpan tanggal dan waktu. 
	 - DATE untuk tanggal, 
	 - DATETIME untuk tanggal dan waktu, dan 
	 - TIMESTAMP juga untuk tanggal dan waktu tetapi dengan format yang berbeda.
	BOOLEAN: Tipe data untuk menyimpan nilai boolean. Biasanya disimbolkan sebagai TRUE atau FALSE. Tipe data ini tidak selalu ada dalam semua DBMS, tetapi dapat diwakili dengan tipe data numerik seperti TINYINT atau INTEGER.
	BLOB: Tipe data untuk menyimpan data biner, seperti gambar atau file. Contoh: BLOB, MEDIUMBLOB, LONGBLOB.
	ENUM: Tipe data yang memungkinkan Anda untuk memilih satu dari beberapa nilai yang telah ditentukan sebelumnya. Contoh: ENUM('nilai1', 'nilai2', 'nilai3').
	JSON: Tipe data untuk menyimpan data dalam format JSON (JavaScript Object Notation). Contoh: JSON. 
*/;

-- soal
CREATE TABLE soal (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    soal TEXT NOT NULL,
    tanggal DATE NOT NULL,
    idPembuat INT(6) NOT NULL
);


-- kelas
CREATE TABLE kelas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(15) NOT NULL,
    tokenKelas VARCHAR(10) NOT NULL,
    sekolah VARCHAR(50) NOT NULL
);


-- guru
CREATE TABLE guru (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    banyakSiswa VARCHAR(20) NOT NULL,
    tokenKelas VARCHAR(10) NOT NULL,
    password VARCHAR(200) NOT NULL,
    noWa VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL
);

-- siswa
CREATE TABLE siswa (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL,
    tokenKelas VARCHAR(10) NOT NULL,
    noWa VARCHAR(20) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(200) NOT NULL
);

-- tugas
CREATE TABLE tugas (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    idSoal INT(6) NOT NULL,
    nama VARCHAR(50) NOT NULL,
    tokenKelas VARCHAR(10) NOT NULL,
    tanggal DATE NOT NULL,
    batas DATETIME NOT NULL
);

-- kumpul
CREATE TABLE kumpul(
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    idSiswa INT(6) NOT NULL,
    idTugas INT(6) NOT NULL,
    idSoal INT(6) NOT NULL,
    nilai INT(3) NOT NULL,
    gambar TEXT NOT NULL,
    tanggalKumpul DATE NOT NULL,
    status VARCHAR(10) NOT NULL DEFAULT 'dikumpul',
    ket VARCHAR(100) NOT NULL
);