 <?php

    require_once("../common/connection.php");

    class FAQ
    {
        private $conn;
        private $table = "faqs";

        public function __construct($conn)
        {
            $this->conn = $conn;
        }

        protected function insertFAQ($content, $cusName, $cusEmail)
        {
            $sql = "INSERT INTO $this->table(faq_content, faq_cus_name, faq_cus_email) " .
                "VALUES(?, ?, ?)";

            try {
                $stmt = $this->conn->prepare($sql);
                $stmt->bind_param("sss", $content, $cusName, $cusEmail);
                $stmt->execute();

                $result = true;
            } catch (Error $e) {
                $result = false;
            }

            return $result;
        }

        protected function getAllFAQs()
        {
            $sql = "SELECT * FROM $this->table WHERE faq_value < 4 ORDER BY faq_value DESC";

            try {
                $stmt = $this->conn->prepare($sql);
                $stmt->execute();

                $result = $stmt->get_result();
            } catch (Error $e) {
                $result = false;
            }

            return $result;
        }

        ////////////////////// Public Access ///////////////
        public function giveAllFAQs()
        {
            return $this->getAllFAQs();
        }
    }
