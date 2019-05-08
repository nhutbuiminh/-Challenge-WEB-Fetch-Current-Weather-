# -Challenge-WEB-Fetch-Current-Weather-
<h1>Giới thiệu</h1>
    <p>Ứng dụng sử dụng data từ api.openweathermap.org </p>
    <p>Sử dụng thư viện CURL của PHP để truyền dữ liệu</p>
    <br>
    <h1>Cách làm</h1>
    <h3>Trong phần PHP</h3>
    <p>Tạo các biến $keyAPI và $cityZip để chứa keyAPI và zipcode</p>
    <p>Tạo biến $googleApiUrl để chứa ApiUrl thay đổi theo zipcode được nhập vào</p>
    <p>Tạo cURL để lấy dữ liệu từ API</p>
    <p>Cấu hình các thông số cần thiết cho cURL</p>
    <p>Khai báo các hàm thực thi và ngắt cURL </p>
    <p>Khai báo một biến $data để chưa dữ liệu và dùng hàm json_decode để nhận và giải mã chuỗi đã mã hóa JSON</p>
    <p>Khai báo biến $currentTime sử dụng hàm time() để lấy thời gian hiện tại </p>
    <h3>Trong phần HTML</h3>
    <p>Tạo một form để nhập zipcode</p>
    <p>Hiển thị các giá trị cần thiết ra màn hình</p>