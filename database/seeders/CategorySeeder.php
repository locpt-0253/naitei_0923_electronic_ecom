<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Laptop',
            'description' => 'Laptop là một thiết bị máy tính có kích thước nhỏ gọn và di động. Nó được thiết kế để sử dụng trong các hoạt động làm việc, giải trí hoặc học tập khi di chuyển mà không cần phải sử dụng những chiếc máy tính để bàn cồng kềnh.',
        ]);
        Category::create([
            'name' => 'Bàn phím',
            'description' => 'Bàn phím là một thiết bị đầu vào cho máy tính, được sử dụng để nhập dữ liệu và điều khiển các chức năng của máy tính. Bàn phím bao gồm một loạt các phím nhấn, các phím chữ, số, các ký tự đặc biệt và các phím chức năng để thực hiện các tác vụ.',
        ]);
        Category::create([
            'name' => 'Âm thanh',
            'description' => 'Âm thanh hay loa là một thiết bị điện tử được sử dụng để phát ra âm thanh. Nó bao gồm các thành phần khác như màng lọc tần số, bộ khuếch đại, điều khiển âm lượng,.. Loa có thể kết nối được với các thiết bị phát âm thanh thông qua dây cáp/kết nối không dây.',
        ]);
        Category::create([
            'name' => 'Ghế công thái học',
            'description' => 'Ghế công thái học là mẫu ghế được thiết kế với hình dáng và các tính năng đặc biệt, giúp giảm thiểu áp lực lên cơ thể, giảm đau lưng và cổ và giúp người sử dụng giữ được tư thế ngồi đúng để tránh những tổn thương do ngồi lâu.',
        ]);
        Category::create([
            'name' => 'Máy chơi game',
            'description' => 'Máy chơi game là một thiết bị điện tử được thiết kế để chơi các trò chơi điện tử. Máy chơi game có thể được chia thành hai loại chính: máy chơi game cầm tay và máy chơi game để bàn.',
        ]);
        Category::create([
            'name' => 'Arm màn hình',
            'description' => 'Arm màn hình là một “tay đỡ” để giữ màn hình máy tính ở vị trí mong muốn. Các loại Arm này thường được thiết kế giúp người dùng điều chỉnh độ cao, góc độ và khoảng cách giữa màn hình và mắt, nhằm tạo ra vị trí làm việc thoải mái và thuận tiện hơn.',
        ]);
        Category::create([
            'name' => 'Chuột',
            'description' => 'Chuột máy tính một thiết bị ngoại vi được sử dụng để điều khiển con trỏ trên màn hình máy tính và thực hiện các thao tác trên giao diện đồ họa. Chuột thông thường được thiết kế nhỏ gọn, có hai, ba hoặc nhiều nút nhấn với bánh xe cuộn được đặt giữa hai nút.',
        ]);
        Category::create([
            'name' => 'Màn hình',
            'description' => 'Màn hình máy tính (Computer display, Visual display unit hay Monitor) là thiết bị điện tử dùng để kết nối với máy tính nhằm mục đích hiển thị và phục vụ cho quá trình giao tiếp giữa người sử dụng với máy tính.',
        ]);
        Category::create([
            'name' => 'Cổng chuyển',
            'description' => 'Cổng chuyển (hay còn gọi là cổng kết nối) là một cổng truyền thông được sử dụng để chuyển đổi tín hiệu từ một loại giao diện sang một loại giao diện khác. Các cổng chuyển thường được sử dụng trong các thiết bị điện tử như máy tính, laptop, máy chiếu...',
        ]);
        Category::create([
            'name' => 'Phần mềm',
            'description' => 'Microsoft là một công ty sản xuất phần mềm lớn nhất thế giới, có trụ sở chính tại Mỹ. Các sản phẩm phần mềm của Microsoft bao gồm hệ điều hành Windows, các ứng dụng văn phòng như Microsoft Office (Word, Excel, PowerPoint, Outlook) và các sản phẩm khác.',
        ]);
        Category::create([
            'name' => 'Phụ kiện & Setup',
            'description' => 'Phụ kiện & Setup bao gồm nhiều sản phẩm khác nhau, phục vụ đa nhu cầu của người dùng. Một số phụ kiện đáng chú ý như: kê tay bàn phím, ốp lưng, dán màn hình, phủ phím, ...',
        ]);
    }
}
