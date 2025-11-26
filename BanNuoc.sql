-- create database BanNuoc;



-- use BanNuoc;



-- create table Menu(
-- MaSP nchar(5) not null primary key,
-- TenSP nchar(30),
-- Loai nchar(20),
-- SoLuong int,
-- HinhAnh nchar(20),
-- Gia float
-- );



-- create table GoiNuoc(
-- MaGoi nchar(5) not null primary key,
-- MaSP nchar(5) ,
-- SoLuong int,
-- ThanhTien float,
-- constraint fk_masp foreign key (MaSP) REFERENCES  Menu(MaSP)
-- );
DELIMITER //
CREATE TRIGGER trg_GoiNuoc_Insert
AFTER INSERT ON GoiNuoc
FOR EACH ROW
BEGIN
     UPDATE Menu
    SET SoLuong = SoLuong - NEW.SoLuong
    WHERE MaSP = NEW.MaSP;
END //
DELIMITER ;

DELIMITER //

CREATE TRIGGER trg_GoiNuoc_Delete
AFTER DELETE ON GoiNuoc
FOR EACH ROW
BEGIN
    UPDATE Menu
    SET SoLuong = SoLuong + OLD.SoLuong
    WHERE MaSP = OLD.MaSP;
END //

DELIMITER ;


DELIMITER //

CREATE TRIGGER trg_GoiNuoc_Update
AFTER UPDATE ON GoiNuoc
FOR EACH ROW
BEGIN
    UPDATE Menu
    SET SoLuong = SoLuong + (OLD.SoLuong - NEW.SoLuong)
    WHERE MaSP = NEW.MaSP;
END //

DELIMITER ;


