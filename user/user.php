<?php 

        class User
        {
                var $id;
                var $name;
                var $first_name;
                var $birth_date;

                const BDD_ID = "id";
                const BDD_NAME = "name";
                const BDD_FIRST = "first";
                const BDD_BIRTH_DATE = "birth_date";
                const BDD_MODIF_DATE = "modif_date";

                function User()
                {
                        $this->id = 0;
                        $this->name = "";
                        $this->first_name = "";
                        $this->birth_date = "";
                }

        }
        function rowToUser($row, $user)
        {
                $user->id = $row[User::BDD_ID];
                $user->name = $row[User::BDD_NAME];
                $user->first = $row[User::BDD_FIRST];
                $user->birth_date = $row[User::BDD_BIRTH_DATE];
        }
?>
