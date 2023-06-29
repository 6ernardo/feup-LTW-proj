<?php
    declare(strict_types = 1);

    class FAQ {
        public int $id;
        public string $question;
        public string $answer;

        public function __construct(int $id, string $question, string $answer){
            $this->id = $id;
            $this->question = $question;
            $this->answer = $answer;
        }

        static function getAllFAQ(PDO $db) : array {
            $stmt = $db->prepare('SELECT * FROM faq');
            $stmt->execute();

            $faqs = array();

            while($faq = $stmt->fetch()){
                $faqs[] = new FAQ($faq['id'], $faq['question'], $faq['answer']);
            }

            return $faqs;
        }
    }
?>