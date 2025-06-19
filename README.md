KChipShop – Website Bán Sheet Nhạc cho Sky: Children of the Light


Giao diện trang chủ của KChipShop với banner giới thiệu và các nội dung nổi bật cho người chơi Sky.
KChipShop là một ứng dụng web được xây dựng trên nền tảng Laravel (PHP) phục vụ việc chia sẻ và mua bán sheet nhạc trực tuyến dành cho cộng đồng người chơi game Sky: Children of the Light
file-wvbdb8s8ry4krahj75ulbz
. Dự án ra đời nhằm lấp đầy khoảng trống khi chưa có nền tảng chuyên biệt giúp người chơi Sky dễ dàng tìm kiếm hoặc thương mại hóa các bản nhạc chuyển soạn riêng cho hệ thống nhạc cụ trong game
file-wvbdb8s8ry4krahj75ulbz
. Điểm đặc biệt là các sheet nhạc được lưu dưới định dạng .txt, mô phỏng cấu trúc phím đàn trong Sky (dựa trên cặp giá trị thời gian – phím nhạc) thay vì ký hiệu nhạc lý truyền thống. Hiện tại, KChipShop mới chạy trên localhost (chưa có bản online chính thức) và mọi giao dịch thanh toán đều chỉ mang tính chất mô phỏng để phục vụ mục đích thử nghiệm, không có giao dịch tài chính thực tế
file-wvbdb8s8ry4krahj75ulbz
.
Tính năng chính
KChipShop cung cấp đầy đủ các chức năng cơ bản cho cả người dùng thông thường và quản trị viên (admin), đảm bảo đáp ứng yêu cầu của một website bán hàng trực tuyến trong phạm vi giả lập
file-wvbdb8s8ry4krahj75ulbz
file-wvbdb8s8ry4krahj75ulbz
:
Chức năng cho người dùng:
Đăng ký tài khoản mới và đăng nhập hệ thống.
Xem và cập nhật hồ sơ cá nhân (thông tin tài khoản, mật khẩu).
Tìm kiếm sheet nhạc theo tiêu đề, thể loại hoặc nhạc cụ; có thể lọc theo người soạn hoặc quốc gia, và sắp xếp theo tên/giá.
Xem chi tiết sheet nhạc: thông tin mô tả, tác giả, bản demo (ví dụ video YouTube) và xem trước nội dung sheet (.txt) ngay trên web.
Thêm sheet nhạc vào giỏ hàng, quản lý giỏ hàng (cập nhật hoặc bỏ sheet khỏi giỏ).
Thanh toán đơn hàng: lựa chọn phương thức thanh toán (mô phỏng cổng VNPAY, MoMo, ...), điền thông tin và xác nhận đặt mua (do chưa tích hợp cổng thực, bước này chỉ giả lập quá trình thanh toán).
Sau khi đặt mua, người dùng có thể theo dõi lịch sử đơn hàng của mình; sheet nhạc đã mua sẽ được quản trị viên gửi qua email đính kèm file .txt hoặc cấp quyền tải về.
Chức năng cho quản trị viên:
Đăng nhập trang quản trị (yêu cầu tài khoản admin).
Truy cập dashboard thống kê: xem doanh thu theo ngày, theo sheet, số lượng đơn hàng, v.v.
Quản lý danh sách sản phẩm (sheet nhạc): thêm sheet mới, chỉnh sửa thông tin sheet, duyệt hoặc xóa các sheet do người dùng khác đăng lên nếu vi phạm.
Quản lý tài khoản người dùng: phê duyệt tài khoản mới (nếu cần), phân quyền người dùng (mặc định user thường, có thể nâng cấp thành người soạn nội dung hoặc kiểm duyệt viên).
Quản lý đơn hàng: xem danh sách đơn đặt hàng, xác nhận thanh toán, gửi sheet nhạc cho người mua (gửi email đính kèm) và đánh dấu đơn hàng đã hoàn thành.
Quản lý các nội dung khác: danh mục thể loại nhạc cụ, thông báo trên trang chủ, mã giảm giá khuyến mãi, v.v.
Cấu trúc thư mục
Dự án được tổ chức theo mô hình MVC của Laravel, phân chia rõ ràng thành các thư mục cho Model, View, Controller và các thành phần khác. Dưới đây là cấu trúc thư mục chính của KChipShop:
plaintext
Sao chép
Chỉnh sửa
KChipShop/  
├── app/  
│   ├── Models/        # Các model Eloquent (User, Product, Order, ...)  
│   ├── Http/Controllers/  # Controllers cho người dùng và admin  
│   └── ...            # Middleware, Providers, etc.  
├── bootstrap/         # Tập tin khởi tạo ứng dụng  
├── config/            # Các cấu hình cho database, mail, etc.  
├── database/  
│   ├── migrations/    # Các file migration tạo bảng cơ sở dữ liệu  
│   ├── seeders/       # (Tùy chọn) Dữ liệu mẫu ban đầu cho database  
│   └── factories/     # (Tùy chọn) Factory tạo dữ liệu giả lập  
├── public/            # Thư mục public (chứa index.php, assets, hình ảnh, CSS, JS)  
├── resources/  
│   ├── views/         # Giao diện Blade templates (frontend cho user & admin)  
│   ├── css/, js/      # (Nếu sử dụng) Mã nguồn CSS/JS để build  
│   └── lang/          # (Tùy chọn) Đa ngôn ngữ  
├── routes/  
│   ├── web.php        # Định nghĩa route cho web (user, admin)  
│   └── api.php        # (Không sử dụng nhiều ở dự án này)  
├── storage/           # Lưu trữ file (upload, cache, logs…)  
├── tests/             # (Tùy chọn) Test unit/integration  
├── .env.example       # Mẫu file cấu hình môi trường (sao chép thành .env khi cài đặt)  
└── composer.json      # Khai báo các package PHP phụ thuộc (Laravel, v.v.)  
Mỗi thư mục đảm nhiệm một vai trò rõ ràng: code backend nằm trong app/ (Models, Controllers), file giao diện Blade trong resources/views/, các route URL định nghĩa tại routes/web.php, và cơ sở dữ liệu MySQL được quản lý thông qua các file migration trong database/migrations/. Kiến trúc này giúp dự án dễ bảo trì và mở rộng về sau
file-wvbdb8s8ry4krahj75ulbz
file-wvbdb8s8ry4krahj75ulbz
.
Hướng dẫn cài đặt và chạy trên máy local
Để cài đặt và chạy KChipShop trên máy local, bạn cần đảm bảo môi trường phát triển với PHP, Composer và MySQL đã được cài đặt. Dự án phát triển trên Laravel 9+, do đó yêu cầu PHP phiên bản 8.x trở lên. Dưới đây là các bước chi tiết:
Clone source code từ GitHub hoặc tải bản phát hành mới nhất. Giả sử bạn đã có mã nguồn trong thư mục KChipShop.
Cài đặt các package PHP bằng Composer: Mở terminal tại thư mục dự án và chạy lệnh:
bash
Sao chép
Chỉnh sửa
composer install
Lệnh này sẽ cài đặt Laravel và các thư viện phụ thuộc được khai báo trong composer.json
file-wvbdb8s8ry4krahj75ulbz
.
Tạo file cấu hình môi trường: Sao chép file .env.example thành .env. Mở file .env và thiết lập các thông số kết nối cơ sở dữ liệu cho phù hợp:
env
Sao chép
Chỉnh sửa
DB_DATABASE=kchipshop    # Tên database (vd: kchipshop)
DB_USERNAME=root         # Username MySQL (vd: root)
DB_PASSWORD=             # Mật khẩu MySQL (nếu có)
Lưu ý: Bạn cần tạo một database trống (ví dụ tên kchipshop) trong MySQL trước khi chạy migration.
Generate application key: chạy lệnh Artisan để tạo khóa ứng dụng:
bash
Sao chép
Chỉnh sửa
php artisan key:generate
Lệnh này sẽ cập nhật APP_KEY trong file .env, đảm bảo bảo mật cho các thông tin phiên, mã hóa.
Chạy migration và seed dữ liệu (nếu có): Thực thi lệnh sau để tạo các bảng cần thiết trong database:
bash
Sao chép
Chỉnh sửa
php artisan migrate
Nếu dự án có kèm dữ liệu mẫu, có thể chạy thêm:
bash
Sao chép
Chỉnh sửa
php artisan db:seed
Kiểm tra MySQL để đảm bảo các bảng như users, products (hoặc danhmuc), orders, carts đã được tạo thành công. Tài khoản admin (nếu chưa có sẵn) có thể được tạo bằng cách đăng ký một tài khoản thường rồi chỉnh cột check của user đó thành 1 trong bảng users
file-wvbdb8s8ry4krahj75ulbz
file-wvbdb8s8ry4krahj75ulbz
.
Build tài nguyên front-end: (Bước này tùy chọn, phụ thuộc vào dự án có sử dụng công cụ build không). Nếu có file package.json và sử dụng Laravel Mix/Vite, hãy cài Node packages và build:
bash
Sao chép
Chỉnh sửa
npm install && npm run dev   # hoặc npm run build cho bản production
Nếu dự án dùng CDN cho CSS/JS (ví dụ Bootstrap, jQuery) thì không cần bước này.
Khởi chạy server local: Sử dụng artisan để chạy ứng dụng:
bash
Sao chép
Chỉnh sửa
php artisan serve
Mặc định ứng dụng sẽ chạy tại http://127.0.0.1:8000 (hoặc http://localhost:8000). Mở trình duyệt và truy cập địa chỉ này để vào trang chủ KChipShop. Nếu không dùng artisan serve, bạn có thể cấu hình host ảo trên XAMPP/Nginx trỏ vào thư mục public/ của dự án.
Sau khi hoàn tất các bước trên, bạn có thể thấy trang web chạy trên trình duyệt với giao diện trang chủ như hình minh họa. Hãy thử đăng ký một tài khoản người dùng mới để bắt đầu trải nghiệm các chức năng.
Ví dụ sử dụng (Usage Example)
Dưới đây là một kịch bản minh họa cách sử dụng các chức năng chính của KChipShop cho người dùng thông thường:
Đăng ký tài khoản và đăng nhập: Trên thanh menu, nhấn Đăng ký để tạo tài khoản mới bằng email và mật khẩu. Sau khi đăng ký thành công, tiến hành Đăng nhập bằng thông tin vừa tạo. (Nếu tài khoản cần xác thực email, bạn có thể bỏ qua trong môi trường giả lập.)
Duyệt sheet nhạc: Sau khi đăng nhập, bạn sẽ được chuyển đến trang chủ hoặc trang “Sản Phẩm”. Tại đây có danh sách các sheet nhạc nổi bật. Bạn có thể nhấn vào mục Sản Phẩm trên menu để xem tất cả sheet nhạc hiện có. Trang sản phẩm hiển thị các thẻ sheet nhạc dưới dạng lưới, kèm ảnh bìa, tiêu đề và giá tiền. Sử dụng thanh tìm kiếm hoặc bộ lọc Người Soạn, Quốc gia, Sắp xếp để thu hẹp danh sách theo ý muốn (ví dụ: lọc sheet do KChip soạn, quốc gia Việt Nam, sắp xếp theo giá tăng dần).


Giao diện trang “Tất Cả Sản Phẩm” với bộ lọc theo người soạn, quốc gia và sắp xếp, hiển thị các sheet nhạc kèm giá bán.
Xem chi tiết và xem trước sheet: Nhấp vào nút “Xem sản phẩm” hoặc tên sheet trên thẻ sản phẩm để đi đến trang chi tiết. Tại đây, bạn sẽ thấy thông tin đầy đủ: mô tả sheet, tác giả, người soạn/transcriber, giá, định dạng, v.v. Nếu sheet có bản demo video hoặc audio, bạn có thể xem trước trực tiếp (như khung video YouTube nhúng). Đặc biệt, phần xem trước sheet .txt sẽ hiển thị một đoạn trích nội dung file .txt (ví dụ vài dòng đầu) để người dùng hình dung bài nhạc.
Thêm vào giỏ hàng: Nếu muốn mua sheet, chọn nút “Thêm vào giỏ hàng” trên trang chi tiết. Một thông báo sẽ xuất hiện xác nhận sheet đã được thêm. Bạn có thể tiếp tục chọn thêm các sheet khác hoặc vào giỏ hàng để thanh toán.
Kiểm tra giỏ hàng: Nhấn biểu tượng giỏ hàng trên thanh menu (góc trên bên phải) để xem các mục đã chọn. Trang giỏ hàng liệt kê danh sách sheet, số lượng, đơn giá và tính tổng tạm tính. Tại đây bạn có thể điều chỉnh số lượng hoặc bỏ bớt sheet nếu muốn. Nếu có mã giảm giá, bạn có thể nhập vào ô “Ưu đãi/Discount code” (nếu chức năng này được bật) để được giảm giá theo chương trình khuyến mãi.
Tiến hành thanh toán: Trong trang giỏ hàng, nhấn “Thanh toán” để bắt đầu đặt hàng. Ở bước này, vì KChipShop đang chạy giả lập, bạn sẽ được chuyển đến trang chọn phương thức thanh toán mà không cần nhập thông tin thẻ tín dụng thực. Chọn một phương thức (ví dụ VNPAY mô phỏng) rồi nhấn xác nhận. Hệ thống sẽ tạo đơn hàng mới và chuyển sang trang theo dõi trạng thái. (Trong thực tế, đây là bước tích hợp cổng thanh toán, nhưng ở bản demo sẽ tự động coi như thanh toán thành công).
Xác nhận và nhận sheet: Sau khi hoàn tất thanh toán (giả lập), bạn sẽ thấy thông báo đặt hàng thành công. Vào mục Đơn hàng (trên menu tài khoản) để xem chi tiết đơn hàng của bạn, bao gồm trạng thái “Chờ xác nhận” hoặc “Đã thanh toán”. Lúc này, quản trị viên sẽ nhận được thông tin đơn hàng. Trong môi trường demo, admin sẽ đóng vai trò xử lý đơn: kiểm tra giao dịch và gửi file sheet .txt qua email cho bạn (sử dụng email mà bạn đăng ký tài khoản)
file-wvbdb8s8ry4krahj75ulbz
. Bạn sẽ nhận được email từ hệ thống KChipShop chứa link tải hoặc file đính kèm sheet nhạc đã mua. Cuối cùng, admin cập nhật trạng thái đơn hàng thành “Đã gửi hàng” và hoàn tất giao dịch.
Lưu ý: Vì hệ thống chưa tích hợp tính năng gửi mail thực tế qua SMTP trong môi trường local, bước gửi email có thể được mô phỏng bằng log hoặc bỏ qua tùy cấu hình. Bạn cũng có thể cấu hình mail trong .env và thử với dịch vụ SMTP miễn phí để kiểm chứng tính năng này. Mọi dữ liệu giao dịch, đơn hàng trong demo đều chỉ mang tính thử nghiệm.
Thông tin nhóm phát triển và đóng góp
Nhóm phát triển dự án KChipShop (Nhóm 11 – Kỹ Thuật Phần Mềm 1-3-24) gồm các thành viên
file-wvbdb8s8ry4krahj75ulbz
:
Lê Ngọc Khánh – Vai trò: Nhóm trưởng, lập trình chính (30% công việc)
Nguyễn Khắc Long – Vai trò: Lập trình backend & database (30%)
Nguyễn Anh Tài – Vai trò: Thiết kế giao diện người dùng, frontend (20%)
Hoàng Ngọc Hưng – Vai trò: Hỗ trợ lập trình và kiểm thử (20%)
Nếu bạn muốn đóng góp hoặc tham gia phát triển dự án, chúng tôi rất hoan nghênh! 🎉 Dưới đây là hướng dẫn cơ bản để cộng đồng có thể đóng góp:
Fork repo trên GitHub về tài khoản của bạn, sau đó tạo nhánh (branch) mới từ nhánh main để thực hiện thay đổi.
Thực hiện các chỉnh sửa hoặc bổ sung tính năng trên branch của bạn. Hãy đảm bảo code tuân thủ các tiêu chuẩn của Laravel/PHP và được kiểm thử cơ bản trước khi gửi.
Commit và push branch lên repo fork của bạn. Mô tả commit rõ ràng về nội dung thay đổi.
Tạo một Pull Request (PR) từ repo của bạn về repo gốc KChipShop, kèm mô tả chi tiết về thay đổi và lý do. Các maintainer sẽ xem xét PR của bạn.
Trao đổi: Bạn có thể mở Issue trên GitHub để thảo luận về bug hoặc đề xuất tính năng mới trước khi bắt tay code. Điều này giúp đảm bảo ý tưởng phù hợp với định hướng dự án.
Tuân thủ quy tắc: Khi đóng góp, vui lòng tuân thủ quy tắc coding style, không chỉnh sửa những phần không cần thiết và tôn trọng quyết định của maintainer về việc hợp nhất code.
Dự án này được thực hiện với mục đích học tập và phục vụ cộng đồng người chơi Sky, do đó mọi ý kiến đóng góp, báo lỗi hay đề xuất tính năng đều đáng quý. Nhóm phát triển sẵn sàng đón nhận sự đóng góp từ các bạn để cùng cải thiện KChipShop ngày càng hoàn thiện hơn. Xin cảm ơn! 🙏
