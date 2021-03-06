<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-03-25
 * @package Database
 */

require_once('SEMObject.class.php');

class MySQL extends SEMObject
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
	/*
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Instance Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function MySQL ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_MySQL'.$numArgs),
                        $args);
        }
        
        
        function _MySQL0 ()
        {
                $this->_initialise();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        /*
        mysql_affected_rows -- Get number of affected rows in previous MySQL operation
        mysql_change_user -- Change logged in user of the active connection
        mysql_client_encoding -- Returns the name of the character set
        mysql_close -- Close MySQL connection
        mysql_connect -- Open a connection to a MySQL Server
        mysql_create_db -- Create a MySQL database
        mysql_data_seek -- Move internal result pointer
        mysql_db_name -- Get result data
        mysql_db_query -- Send a MySQL query
        mysql_drop_db -- Drop (delete) a MySQL database
        mysql_errno -- Returns the numerical value of the error message from previous MySQL operation
        mysql_error -- Returns the text of the error message from previous MySQL operation
        mysql_escape_string -- Escapes a string for use in a mysql_query
        mysql_fetch_array -- Fetch a result row as an associative array, a numeric array, or both
        mysql_fetch_assoc -- Fetch a result row as an associative array
        mysql_fetch_field -- Get column information from a result and return as an object
        mysql_fetch_lengths -- Get the length of each output in a result
        mysql_fetch_object -- Fetch a result row as an object
        mysql_fetch_row -- Get a result row as an enumerated array
        mysql_field_flags -- Get the flags associated with the specified field in a result
        mysql_field_len -- Returns the length of the specified field
        mysql_field_name -- Get the name of the specified field in a result
        mysql_field_seek -- Set result pointer to a specified field offset
        mysql_field_table -- Get name of the table the specified field is in
        mysql_field_type -- Get the type of the specified field in a result
        mysql_free_result -- Free result memory
        mysql_get_client_info -- Get MySQL client info
        mysql_get_host_info -- Get MySQL host info
        mysql_get_proto_info -- Get MySQL protocol info
        mysql_get_server_info -- Get MySQL server info
        mysql_info -- Get information about the most recent query
        mysql_insert_id -- Get the ID generated from the previous INSERT operation
        mysql_list_dbs -- List databases available on a MySQL server
        mysql_list_fields -- List MySQL table fields
        mysql_list_processes -- List MySQL processes
        mysql_list_tables -- List tables in a MySQL database
        mysql_num_fields -- Get number of fields in result
        mysql_num_rows -- Get number of rows in result
        mysql_pconnect -- Open a persistent connection to a MySQL server
        mysql_ping -- Ping a server connection or reconnect if there is no connection
        mysql_query -- Send a MySQL query
        mysql_real_escape_string -- Escapes special characters in a string for use in a SQL statement
        mysql_result -- Get result data
        mysql_select_db -- Select a MySQL database
        mysql_stat -- Get current system status
        mysql_tablename -- Get table name of field
        mysql_thread_id -- Return the current thread ID
        mysql_unbuffered_query
        */
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        
        
        
}

?>
