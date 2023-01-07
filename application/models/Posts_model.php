<?php 

    class Posts_model extends CI_Model {

        public function __construct() {
            $this->load->database();
        }

        // this function basically gets all of the information within the table blogs then return it as an associative array
        public function get_posts() {
            $query = $this->db->get('blogs');
            return $query->result_array();
        }

        public function get_single_post($param) {
            $query = $this->db->get_where('blogs', array('id' => $param));
            return $query->row_array();

            // The same as the code above
            /* 
                $this->db->where('id', $param);
                $result = $this->db->get('blogs');
                return $result->row_array();
            */
        }

        public function check_post() {
            // https://codeigniter.com/userguide3/libraries/input.html#using-post-get-cookie-or-server-data
            $title = $this->input->post('title');
            $query = $this->db->get_where('blogs', array('title' => $title));

            $result = $query->result();

            return $result;
        }

        public function insert_post() {
            // https://codeigniter.com/userguide3/libraries/input.html#using-post-get-cookie-or-server-data
            $title = $this->input->post('title');
            $body = $this->input->post('body');

            // since this is an associative array
            // the key is the parameter for the insert query
            // while the value parameter is the same one for the query
            $data = array(
                'title' => $title,
                'body' => $body
            );

            $this->db->insert('blogs', $data);
        }

        public function edit_post() {
            $id = $this->input->post('id');
            $title = $this->input->post('title');
            $body = $this->input->post('body');

            $data = array(
                'title' => $title,
                'body' => $body
            );

            $this->db->where('id', $id);
            $this->db->update('blogs', $data);
        }

        public function delete_post() {
            $id = $this->input->post('id');
            $this->db->delete('blogs', array('id' => $id)); 
        }
    }

?>