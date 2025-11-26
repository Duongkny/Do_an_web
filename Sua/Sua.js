function fillForm(ma,ten ,danhmuc,soluong,hinhanh,gia){
    document.getElementById("MaSP").value = ma;
    document.getElementById("TenSP").value = ten; 
    document.getElementById("category").value = danhmuc;
    document.getElementById("SoLuong").value = soluong;
    document.getElementById("price").value = gia;
    document.getElementById("HinhAnh").src= '../img/' + hinhanh ;
}   