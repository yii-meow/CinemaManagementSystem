<?php

class Test {

    // Call to the database
    // Specify the query
    public function getTestFunction($sqlParameters) {
        return Database::query("SELECT testAttribute1, testAttribute2 FROM test LIMIT ?", [$sqlParameters]);
    }


}

?>