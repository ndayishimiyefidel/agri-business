<?php
require_once('../salesadmin/../includes/cnx.php');
// check if user logge in or not
if (!isset($_SESSION['isUserLoggedIn'])) {
    echo "<script>
alert('Plz , Login first !')
</script>";
    echo "<script>
window.location.href = '../index.php';
</script>";
} ?>
<?php
$now = time(); // Checking the time now when home page starts.

if ($now > $_SESSION['expire']) {
    session_destroy();
    echo "<script>alert('Your session have been expired,login again')</script>";
    echo  "<script>window.location.href = '../index.php';</script>";
}
$user_email = $_SESSION['emailId'];

class Model
{

    // private $server = "localhost";
    // private $username = "root";
    // private $password = "";
    // private $db = "Inventory MIS";
    // private $conn;

    private $server = 'byywvw085lrejkkfpsjy-mysql.services.clever-cloud.com';
    private $username = 'u35agjgltywq2yvq';
    private $password = 'SrWOTxZAXBAMdGInScek';
    private $db = "byywvw085lrejkkfpsjy";
    private $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->server, $this->username, $this->password, $this->db);
        } catch (\Throwable $th) {
            //throw $th;
            echo "Connection error " . $th->getMessage();
        }
    }

    public function fetch()
    {
        $user_id = $_SESSION['userId'];
        $data = [];
        $query = "SELECT
        customers.firstname,
        customers.lastname,
        customers.telphone,
        customers.district,
        products.product_name,
        orders.order_id,
        orders.unit_price,
        orders.qty,
        orders.order_date,
        orders.status
    FROM
        customers,
        products,
        orders
    WHERE
        orders.id = '$user_id' AND orders.customer_id = customers.customer_id AND orders.pr_id = products.pr_id AND orders.status = 'Received'";
        if ($sql = $this->conn->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                $data[] = $row;
            }
        }

        return $data;
    }

    public function date_range($start_date, $end_date)
    {
        $user_id = $_SESSION['userId'];
        $data = [];

        if (isset($start_date) && isset($end_date)) {
            // $query = "SELECT * FROM `orders` WHERE `order_date` > '$start_date' AND `order_date` < '$end_date'";
            $query = "SELECT
    customers.firstname,
    customers.lastname,
    customers.telphone,
    customers.district,
    products.product_name,
    orders.order_id,
    orders.unit_price,
    orders.qty,
    orders.status,
    orders.order_date
    
FROM
    customers,
    products,
    orders
WHERE
    orders.id = '$user_id' AND orders.customer_id = customers.customer_id AND orders.pr_id = products.pr_id AND orders.order_date > '$start_date' AND orders.order_date < '$end_date'
            AND orders.status='Received'";
            if ($sql = $this->conn->query($query)) {
                while ($row = mysqli_fetch_assoc($sql)) {
                    $data[] = $row;
                }
            }
        }

        return $data;
    }
}