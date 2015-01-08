<?php
/**
 * Example of how to check if a field is updated
 */
class FieldChangeHook
{
    protected static $fetchedRow = array();
    
    /**
     * Called as before_save logic hook to grab the fetched_row values
     */
    public function saveFetchedRow($bean, $event, $arguments)
    {
        if ( !empty($bean->id) ) {
            self::$fetchedRow[$bean->id] = $bean->fetched_row;
        }
        // check if password updated
        if(self::$fetchedRow[$bean->id]['password_c'] != $bean->password_c ){
            $bean->password_c = sha1( $bean->password_c );
            $text = "Password Update for Account id ".$bean->id." from: ".self::$fetchedRow[$bean->id]['password_c']." to ".$bean->password_c;
            $this->writeLogFile($text);
            $this->updateRemoteDB( $bean->id, $bean->password_c );
        }
    }
    public function updateRemoteDB( $id, $password ){
        include ( "custom/modules/Accounts/RemoteDB.class.php");
        $remoteDB = new RemoteDB();
        $updateQuery = "UPDATE users SET password=\"".$password."\" WHERE sugarcrm_id=\"".$id."\"";
        if(!$remoteDB->update( $updateQuery )){
            $this->writeLogFile(
                "Failed to update password in remote DB with id ".$id.": ".
                $remoteDB->errorMessage
            );
        }
    }
    /**
     * Called as a after_save logic hook to execute the actual business process
     */
    public function executeBusinessProcess($bean, $event, $arguments)
    {
        // call on changed records only
        if ( isset(self::$fetchedRow[$bean->id])){ 
            if($bean->password_c != self::$fetchedRow[$bean->id]['password_c'] ) {
            $text = "Password Update for Account id ".$bean->id." from: ".self::$fetchedRow[$bean->id]['password_c']." to ".$bean->password_c;
            //
            // execute changed record business process
            //
            }
        }
        
        // call on new records only
        if ( !isset(self::$fetchedRow[$bean->id]) ) {
            //
            // execute new record business process
            //
        }
    }
  }
?>
