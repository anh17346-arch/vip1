# Hướng dẫn sử dụng hệ thống quản lý khuyến mãi

## Tổng quan

Hệ thống quản lý khuyến mãi cho phép admin tạo, quản lý và theo dõi các chương trình khuyến mãi cho sản phẩm nước hoa. Hệ thống hỗ trợ nhiều loại khuyến mãi khác nhau với các tính năng linh hoạt.

## Tính năng chính

### 1. Quản lý khuyến mãi
- **Tạo khuyến mãi mới**: Tạo chương trình khuyến mãi với đầy đủ thông tin
- **Chỉnh sửa khuyến mãi**: Cập nhật thông tin khuyến mãi hiện có
- **Xem chi tiết**: Hiển thị thông tin chi tiết về khuyến mãi
- **Xóa khuyến mãi**: Xóa khuyến mãi không còn cần thiết
- **Kích hoạt/Vô hiệu**: Bật/tắt khuyến mãi nhanh chóng

### 2. Loại giảm giá
- **Giảm giá theo phần trăm**: Giảm giá theo tỷ lệ phần trăm (VD: 15%)
- **Giảm giá cố định**: Giảm giá theo số tiền cố định (VD: 200,000 VNĐ)

### 3. Đối tượng áp dụng
- **Tất cả sản phẩm**: Áp dụng cho toàn bộ sản phẩm trong hệ thống
- **Danh mục cụ thể**: Chỉ áp dụng cho sản phẩm trong danh mục được chọn
- **Sản phẩm cụ thể**: Chỉ áp dụng cho các sản phẩm được chọn lọc

### 4. Đối tượng khách hàng
- **Tất cả người dùng**: Áp dụng cho mọi khách hàng
- **Người dùng mới**: Chỉ áp dụng cho khách hàng đăng ký ≤ 30 ngày
- **Người dùng cũ**: Chỉ áp dụng cho khách hàng đăng ký > 30 ngày

### 5. Quản lý thời gian
- **Ngày bắt đầu**: Thời điểm khuyến mãi bắt đầu có hiệu lực
- **Ngày kết thúc**: Thời điểm khuyến mãi hết hiệu lực
- **Tự động kiểm tra**: Hệ thống tự động kiểm tra tính hợp lệ của khuyến mãi

### 6. Giới hạn sử dụng
- **Giới hạn lượt sử dụng**: Thiết lập số lượt sử dụng tối đa
- **Theo dõi sử dụng**: Hiển thị số lượt đã sử dụng và còn lại
- **Không giới hạn**: Có thể thiết lập khuyến mãi không giới hạn lượt sử dụng

## Cách sử dụng

### 1. Truy cập quản lý khuyến mãi
1. Đăng nhập vào hệ thống với tài khoản admin
2. Vào trang Dashboard
3. Tìm phần "Quản lý khuyến mãi"
4. Chọn "Quản lý khuyến mãi" để xem danh sách hoặc "Tạo khuyến mãi mới" để tạo mới

### 2. Tạo khuyến mãi mới
1. Nhấn "Tạo khuyến mãi mới"
2. Điền thông tin cơ bản:
   - Tên khuyến mãi (bắt buộc)
   - Tên khuyến mãi tiếng Anh (tùy chọn)
   - Mô tả
   - Mã khuyến mãi (bắt buộc, có thể tự động tạo)
3. Cấu hình giảm giá:
   - Chọn loại giảm giá (phần trăm hoặc số tiền cố định)
   - Nhập giá trị giảm giá
   - Thiết lập giá trị đơn hàng tối thiểu (nếu có)
   - Thiết lập giảm giá tối đa (nếu có)
4. Thiết lập thời gian:
   - Ngày bắt đầu
   - Ngày kết thúc
5. Chọn đối tượng áp dụng:
   - Phạm vi sản phẩm
   - Loại người dùng
6. Thiết lập giới hạn sử dụng (tùy chọn)
7. Chọn trạng thái kích hoạt
8. Nhấn "Tạo khuyến mãi"

### 3. Quản lý khuyến mãi
- **Xem danh sách**: Hiển thị tất cả khuyến mãi với thông tin tóm tắt
- **Xem chi tiết**: Nhấn vào icon mắt để xem thông tin chi tiết
- **Chỉnh sửa**: Nhấn vào icon bút để chỉnh sửa
- **Kích hoạt/Vô hiệu**: Nhấn vào icon check để bật/tắt
- **Xóa**: Nhấn vào icon thùng rác để xóa

### 4. Theo dõi trạng thái
Hệ thống tự động hiển thị trạng thái khuyến mãi:
- **Hoạt động**: Khuyến mãi đang có hiệu lực
- **Sắp diễn ra**: Khuyến mãi chưa đến thời gian bắt đầu
- **Hết hạn**: Khuyến mãi đã quá thời gian kết thúc
- **Vô hiệu**: Khuyến mãi bị tắt thủ công
- **Hết lượt**: Khuyến mãi đã đạt giới hạn sử dụng

## Cấu trúc cơ sở dữ liệu

### Bảng `promotions`
- `id`: ID khuyến mãi
- `name`: Tên khuyến mãi
- `name_en`: Tên khuyến mãi tiếng Anh
- `description`: Mô tả
- `description_en`: Mô tả tiếng Anh
- `discount_type`: Loại giảm giá (percentage/fixed_amount)
- `discount_value`: Giá trị giảm giá
- `min_order_amount`: Giá trị đơn hàng tối thiểu
- `max_discount_amount`: Giảm giá tối đa
- `usage_limit`: Giới hạn lượt sử dụng
- `used_count`: Số lượt đã sử dụng
- `start_date`: Ngày bắt đầu
- `end_date`: Ngày kết thúc
- `is_active`: Trạng thái kích hoạt
- `code`: Mã khuyến mãi
- `applies_to`: Phạm vi áp dụng
- `category_ids`: ID danh mục (JSON)
- `product_ids`: ID sản phẩm (JSON)
- `user_type`: Loại người dùng
- `created_by`: ID người tạo
- `created_at`: Ngày tạo
- `updated_at`: Ngày cập nhật

### Bảng `promotion_categories`
- `promotion_id`: ID khuyến mãi
- `category_id`: ID danh mục

### Bảng `promotion_products`
- `promotion_id`: ID khuyến mãi
- `product_id`: ID sản phẩm

## API Endpoints

### Quản lý khuyến mãi
- `GET /admin/promotions` - Danh sách khuyến mãi
- `GET /admin/promotions/create` - Form tạo khuyến mãi
- `POST /admin/promotions` - Tạo khuyến mãi
- `GET /admin/promotions/{id}` - Xem chi tiết
- `GET /admin/promotions/{id}/edit` - Form chỉnh sửa
- `PUT /admin/promotions/{id}` - Cập nhật khuyến mãi
- `DELETE /admin/promotions/{id}` - Xóa khuyến mãi

### Các chức năng khác
- `POST /admin/promotions/{id}/toggle-status` - Bật/tắt khuyến mãi
- `GET /admin/promotions/generate-code` - Tạo mã khuyến mãi tự động

## Lưu ý quan trọng

1. **Mã khuyến mãi**: Phải là duy nhất trong hệ thống
2. **Thời gian**: Ngày kết thúc phải sau ngày bắt đầu
3. **Giá trị giảm giá**: Phải lớn hơn 0
4. **Giới hạn sử dụng**: Nếu thiết lập, phải lớn hơn 0
5. **Quyền truy cập**: Chỉ admin mới có quyền quản lý khuyến mãi
6. **Tính toán giảm giá**: Hệ thống tự động tính toán giảm giá dựa trên cấu hình

## Troubleshooting

### Lỗi thường gặp
1. **Mã khuyến mãi đã tồn tại**: Chọn mã khuyến mãi khác hoặc sử dụng tính năng tự động tạo
2. **Thời gian không hợp lệ**: Đảm bảo ngày kết thúc sau ngày bắt đầu
3. **Giá trị không hợp lệ**: Kiểm tra các giá trị số phải lớn hơn 0

### Hỗ trợ
Nếu gặp vấn đề, vui lòng liên hệ admin hoặc kiểm tra logs hệ thống.