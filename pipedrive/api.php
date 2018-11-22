<?php

/*
 * pipedrive api by NickChou
 */

class API {

    private $api_token = "096e71740c3dc31f977310226cb387d52a39841a";

    function get_method($method_name) {

        if ($method_name == "find_contact_name" || $method_name == "find_contact_email") {
            $method_path = "persons/find";
        } elseif ($method_name == "create_contact" || $method_name == "update_contact") {
            $method_path = "persons";
        } elseif ($method_name == "create_deal" || $method_name == "update_deal") {
            $method_path = "deals";
        } elseif ($method_name == "find_deal_name") {
            $method_path = "deals/find";
        } elseif ($method_name == "find_deal_id") {
            $method_path = "dealsid";
        }

        return $method_path;
    }

// use post to connect with pipedrive
    function post_pipedrive($method_path, $data) {
        $pa = "";
        foreach ($data as $key => $value) {
            $pa .= $key . '=' . $value . '&';
        }
        $url = "https://api.pipedrive.com/v1/" . $method_path . "?api_token=" . $this->api_token;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $pa);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        $response = curl_exec($ch);
        if ($response === false) {
            echo "Error Number:" . curl_errno($ch) . "<br>";
            echo "Error String:" . curl_error($ch);
        }
        curl_close($ch);
        return $response;
    }

    // use get to connect with pipedrive
    function get_pipedrive($method_path, $data) {
        if ($method_path == "dealsid") {
            $url = "https://api.pipedrive.com/v1/deals/" . $data . "?api_token=" . $this->api_token;
        } else {
            $pa = "";
            foreach ($data as $key => $value) {
                $pa .= $key . '=' . $value . '&';
            }
            $to_be_sent = $pa . "api_token=" . $this->api_token;
            $url = "https://api.pipedrive.com/v1/" . $method_path . "?" . $to_be_sent;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false) {
            echo "Error Number:" . curl_errno($ch) . "<br>";
            echo "Error String:" . curl_error($ch);
        }
        curl_close($ch);
        return $response;
    }

    //ust put to connect pipedrive
    function put_pipedrive($id, $method_path, $data) {
        $data_json = json_encode($data);
        $url = "https://api.pipedrive.com/v1/" . $method_path . "/" . $id . "?api_token=" . $this->api_token;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_json);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data_json))
        );
        $response = curl_exec($ch);
        if ($response === false) {
            echo "Error Number:" . curl_errno($ch) . "<br>";
            echo "Error String:" . curl_error($ch);
        }
        curl_close($ch);
        return $response;
    }

    //find person contact by name
    function find_contact_name($data) {
        $para = array(
            'term' => $data["name"],
        );
        $method_path = $this->get_method("find_contact_name");
        $result = $this->get_pipedrive($method_path, $para, null);
        return $result;

        // yes:Array ( [success] => 1 [data] => Array ( [0] => Array ( [id] => 8220 [name] => Aaron Jenner [email] => aaron@cooke.toyota.co.nz [phone] => 274770507 [org_id] => [org_name] => [visible_to] => 1 ) ) [additional_data] => Array ( [search_method] => search [pagination] => Array ( [start] => 0 [limit] => 100 [more_items_in_collection] => ) ) )
//no:{"success":true,"data":null,"additional_data":{"search_method":"search","pagination":{"start":0,"limit":100,"more_items_in_collection":false}}}
    }

     //find person contact by email
    function find_contact_email($data) {
        $para = array(
            'term' => $data["email"],
            'search_by_email' => 1
        );
        $method_path = $this->get_method("find_contact_email");
        $result = $this->get_pipedrive($method_path, $para, null);
        return $result;

        // yes:Array ( [success] => 1 [data] => Array ( [0] => Array ( [id] => 8220 [name] => Aaron Jenner [email] => aaron@cooke.toyota.co.nz [phone] => 274770507 [org_id] => [org_name] => [visible_to] => 1 ) ) [additional_data] => Array ( [search_method] => search [pagination] => Array ( [start] => 0 [limit] => 100 [more_items_in_collection] => ) ) )
//no:{"success":true,"data":null,"additional_data":{"search_method":"search","pagination":{"start":0,"limit":100,"more_items_in_collection":false}}}
    }

    //create new person contact
    function create_contact($data) {
        $method_path = $this->get_method("create_contact");
        $result = $this->post_pipedrive($method_path, $data);
        return $result;
        /*
          {"success":true,"data":{"id":12632,"company_id":1138192,"owner_id":{"id":1623105,"name":"Master Franchisor","email":"chrisc@traffic.net.nz","has_pic":false,"pic_hash":null,"active_flag":true,"value":1623105},"org_id":null,"name":"Nick Jonas","first_name":"Nick","last_name":"Jonas","open_deals_count":0,"closed_deals_count":null,"participant_open_deals_count":0,"participant_closed_deals_count":0,"email_messages_count":0,"activities_count":null,"done_activities_count":null,"undone_activities_count":null,"reference_activities_count":null,"files_count":null,"notes_count":0,"followers_count":0,"won_deals_count":0,"lost_deals_count":0,"active_flag":true,"phone":[{"label":"","value":"1234567890","primary":true}],"email":[{"label":"","value":"nickjonas@gmail.com","primary":true}],"first_char":"n","update_time":"2016-08-24 02:25:31","add_time":"2016-08-24 02:25:31","visible_to":"1","picture_id":null,"next_activity_date":null,"next_activity_time":null,"next_activity_id":null,"last_activity_id":null,"last_activity_date":null,"last_incoming_mail_time":null,"last_outgoing_mail_time":null,"aa66dbbc8863ab49c03175d0788fb0c04ae7f7a3":null,"b12a96458b1a21fcc4d18af4aa9c7b04fae3caf8":null,"c05324ca675eec21d1cbb85c31dfd22b3a9d141a":null,"4ca796c5ae1508b564af3fb381be2cfeebac027e":null,"4dd1b9682cfd5536bc4f81d9828aa528fa54205d":null,"5711655f5dae17df35c4dd7f4ef49392037c6645":null,"c5bdb9ec397a832a5d44d4594cf0fee6abfc1452":null,"org_name":null,"cc_email":"traffic@pipedrivemail.com","owner_name":"Master Franchisor"},"related_objects":{"user":{"1623105":{"id":1623105,"name":"Master Franchisor","email":"chrisc@traffic.net.nz","has_pic":false,"pic_hash":null,"active_flag":true}}}}
         *         */
    }

    //update a person contact
    function update_contact($id, $data) {
        $method_path = $this->get_method("update_contact");
        $result = $this->put_pipedrive($id, $method_path, $data);
        return $result;
        /*
          {"success":true,"data":{"id":12631,"company_id":1138192,"owner_id":{"id":1623105,"name":"Master Franchisor","email":"chrisc@traffic.net.nz","has_pic":false,"pic_hash":null,"active_flag":true,"value":1623105},"org_id":null,"name":"Nick Chou","first_name":"Nick","last_name":"Chou","open_deals_count":0,"closed_deals_count":null,"participant_open_deals_count":0,"participant_closed_deals_count":0,"email_messages_count":0,"activities_count":null,"done_activities_count":null,"undone_activities_count":null,"reference_activities_count":null,"files_count":0,"notes_count":0,"followers_count":1,"won_deals_count":0,"lost_deals_count":0,"active_flag":true,"phone":[{"label":"","value":"1234567890","primary":true}],"email":[{"label":"","value":"nickchou@gmail.com","primary":true}],"first_char":"n","update_time":"2016-08-24 04:25:24","add_time":"2016-08-24 01:53:20","visible_to":"1","picture_id":null,"next_activity_date":null,"next_activity_time":null,"next_activity_id":null,"last_activity_id":null,"last_activity_date":null,"last_incoming_mail_time":null,"last_outgoing_mail_time":null,"aa66dbbc8863ab49c03175d0788fb0c04ae7f7a3":null,"b12a96458b1a21fcc4d18af4aa9c7b04fae3caf8":null,"c05324ca675eec21d1cbb85c31dfd22b3a9d141a":null,"4ca796c5ae1508b564af3fb381be2cfeebac027e":null,"4dd1b9682cfd5536bc4f81d9828aa528fa54205d":null,"5711655f5dae17df35c4dd7f4ef49392037c6645":null,"c5bdb9ec397a832a5d44d4594cf0fee6abfc1452":null,"org_name":null,"cc_email":"traffic@pipedrivemail.com"},"related_objects":{"user":{"1623105":{"id":1623105,"name":"Master Franchisor","email":"chrisc@traffic.net.nz","has_pic":false,"pic_hash":null,"active_flag":true}}}} */
    }

    //creat new deal
    function create_deal($data) {
        $method_path = $this->get_method("create_deal");
        $result = $this->post_pipedrive($method_path, $data);
        return $result;

        /*
          {
          "success": true,
          "data": {
          "id": 10310,
          "creator_user_id": {
          "id": 1623105,
          "name": "Master Franchisor",
          "email": "chrisc@traffic.net.nz",
          "has_pic": false,
          "pic_hash": null,
          "active_flag": true,
          "value": 1623105
          },
          "user_id": {
          "id": 1623105,
          "name": "Master Franchisor",
          "email": "chrisc@traffic.net.nz",
          "has_pic": false,
          "pic_hash": null,
          "active_flag": true,
          "value": 1623105
          },
          "person_id": {
          "name": "Nick Chou",
          "email": [
          {
          "label": "",
          "value": "nickchou131@gmail.com",
          "primary": true
          }
          ],
          "phone": [
          {
          "label": "",
          "value": "1234567890",
          "primary": true
          }
          ],
          "value": 12636
          },
          "org_id": null,
          "stage_id": 1,
          "title": "Nick Chou Deal",
          "value": 0,
          "currency": "NZD",
          "add_time": "2016-08-24 04:51:38",
          "update_time": "2016-08-24 04:51:38",
          "stage_change_time": null,
          "active": true,
          "deleted": false,
          "status": "open",
          "next_activity_date": null,
          "next_activity_time": null,
          "next_activity_id": null,
          "last_activity_id": null,
          "last_activity_date": null,
          "lost_reason": null,
          "visible_to": "1",
          "close_time": null,
          "pipeline_id": 1,
          "won_time": null,
          "first_won_time": null,
          "lost_time": null,
          "products_count": null,
          "files_count": null,
          "notes_count": 0,
          "followers_count": 0,
          "email_messages_count": null,
          "activities_count": null,
          "done_activities_count": null,
          "undone_activities_count": null,
          "reference_activities_count": null,
          "participants_count": 0,
          "expected_close_date": null,
          "last_incoming_mail_time": null,
          "last_outgoing_mail_time": null,
          "9b21838f5cf524dcd827642d67a8b7267bf162d7": null,
          "b523227d010c0d114268d05b57f6d837baf2f86c": null,
          "6acf422c359b054ade6ec4853a07604d2653c1fd": null,
          "58f3459195ac12eb59dd0f6c0c29d8f9c7b1ab8e": null,
          "d125216eaaa0b55f6adf23b268359b0feaf837c9": null,
          "598fbdb608ec2ab627174807432a9578b7206f22": null,
          "03197a58402293106dd45764ea9d3b6d45c936d5": null,
          "stage_order_nr": 1,
          "person_name": "Nick Chou",
          "org_name": null,
          "next_activity_subject": null,
          "next_activity_type": null,
          "next_activity_duration": null,
          "next_activity_note": null,
          "formatted_value": "$0",
          "rotten_time": "2016-08-31 04:51:38",
          "weighted_value": 0,
          "formatted_weighted_value": "$0",
          "owner_name": "Master Franchisor",
          "cc_email": "traffic+deal10310@pipedrivemail.com",
          "org_hidden": false,
          "person_hidden": false
          },
          "related_objects": {
          "user": {
          "1623105": {
          "id": 1623105,
          "name": "Master Franchisor",
          "email": "chrisc@traffic.net.nz",
          "has_pic": false,
          "pic_hash": null,
          "active_flag": true
          }
          },
          "person": {
          "12636": {
          "id": 12636,
          "name": "Nick Chou",
          "email": [
          {
          "label": "",
          "value": "nickchou131@gmail.com",
          "primary": true
          }
          ],
          "phone": [
          {
          "label": "",
          "value": "1234567890",
          "primary": true
          }
          ]
          }
          }
          }
          }
         */
    }

    //update a deal
    function update_deal($id, $data) {
        $method_path = $this->get_method("update_deal");
        $result = $this->put_pipedrive($id, $method_path, $data);
        return $result;
    }

    //find deal by person contact name and deal title
    function find_deal_name($data, $person_id) {
        $para = array(
            'term' => $data["name"] . " Deal",
            'person_id' => $person_id,
        );
        $method_path = $this->get_method("find_deal_name");
        $result = $this->get_pipedrive($method_path, $para);
        return $result;
        /*
          {"success":true,"data":[{"id":10317,"title":"Nick Chou Deal","user_id":1623105,"visible_to":"1","status":"open","value":0,"currency":"NZD","person_name":"Nick Chou","person_id":12644,"organization_name":null,"organization_id":null,"formatted_value":"$0","cc_email":"traffic+deal10317@pipedrivemail.com"},{"id":10318,"title":"Nick Chou Deal","user_id":1623105,"visible_to":"1","status":"open","value":0,"currency":"NZD","person_name":"Nick Chou","person_id":12644,"organization_name":null,"organization_id":null,"formatted_value":"$0","cc_email":"traffic+deal10318@pipedrivemail.com"}],"additional_data":{"pagination":{"start":0,"limit":100,"more_items_in_collection":false}}}
         *          */
    }

    //find deal detail by deal id
    function find_deal_id($deal_id) {
        $method_path = $this->get_method("find_deal_id");
        $result = $this->get_pipedrive($method_path, $deal_id);
        return $result;
        /*
          {
          "success": true,
          "data": {
          "id": 10375,
          "creator_user_id": {
          "id": 1623105,
          "name": "Master Franchisor",
          "email": "chrisc@traffic.net.nz",
          "has_pic": false,
          "pic_hash": null,
          "active_flag": true,
          "value": 1623105
          },
          "user_id": {
          "id": 1623105,
          "name": "Master Franchisor",
          "email": "chrisc@traffic.net.nz",
          "has_pic": false,
          "pic_hash": null,
          "active_flag": true,
          "value": 1623105
          },
          "person_id": {
          "name": "Nick Chou",
          "email": [
          {
          "label": "",
          "value": "nickchou131@gmail.com",
          "primary": true
          }
          ],
          "phone": [
          {
          "label": "",
          "value": "0273250942",
          "primary": true
          }
          ],
          "value": 12702
          },
          "org_id": null,
          "stage_id": 15,
          "title": "Nick Chou Deal",
          "value": 0,
          "currency": "NZD",
          "add_time": "2016-09-06 21:54:43",
          "update_time": "2016-09-06 21:54:44",
          "stage_change_time": null,
          "active": true,
          "deleted": false,
          "status": "open",
          "next_activity_date": null,
          "next_activity_time": null,
          "next_activity_id": null,
          "last_activity_id": null,
          "last_activity_date": null,
          "lost_reason": null,
          "visible_to": "1",
          "close_time": null,
          "pipeline_id": 3,
          "won_time": null,
          "first_won_time": null,
          "lost_time": null,
          "products_count": null,
          "files_count": null,
          "notes_count": 0,
          "followers_count": 1,
          "email_messages_count": null,
          "activities_count": null,
          "done_activities_count": null,
          "undone_activities_count": null,
          "reference_activities_count": null,
          "participants_count": 1,
          "expected_close_date": null,
          "last_incoming_mail_time": null,
          "last_outgoing_mail_time": null,
          "9b21838f5cf524dcd827642d67a8b7267bf162d7": null,
          "b523227d010c0d114268d05b57f6d837baf2f86c": null,
          "6acf422c359b054ade6ec4853a07604d2653c1fd": null,
          "58f3459195ac12eb59dd0f6c0c29d8f9c7b1ab8e": null,
          "d125216eaaa0b55f6adf23b268359b0feaf837c9": null,
          "598fbdb608ec2ab627174807432a9578b7206f22": null,
          "03197a58402293106dd45764ea9d3b6d45c936d5": "Zones Franchise Website",
          "40079ae398288c5fe0a7775731a7b752d5ef07c2": null,
          "b02f1fdf1d4985094631af3a6a4dea9d3acb99f2": "0002 Zones - Business Opportunity - used for Franchise Enquiry",
          "dea8395431c0f22108796567858d8b31729069fa": "New Zealand",
          "cce125edda19d5f999a8643db3bb4cae1139c736": null,
          "46a3299d657baba2a9de0731eb7ae060c7f901d9": "Testingd",
          "e7b57b754f31bb28f953244fb7a88f3c8149eb22": "Aucklandd",
          "stage_order_nr": 2,
          "person_name": "Nick Chou",
          "org_name": null,
          "next_activity_subject": null,
          "next_activity_type": null,
          "next_activity_duration": null,
          "next_activity_note": null,
          "formatted_value": "$0",
          "rotten_time": "2016-09-26 21:54:44",
          "weighted_value": 0,
          "formatted_weighted_value": "$0",
          "owner_name": "Master Franchisor",
          "cc_email": "traffic+deal10375@pipedrivemail.com",
          "org_hidden": false,
          "person_hidden": false,
          "average_time_to_won": {
          "y": 0,
          "m": 0,
          "d": 0,
          "h": 0,
          "i": 0,
          "s": 0,
          "total_seconds": 0
          },
          "average_stage_progress": 0,
          "age": {
          "y": 0,
          "m": 0,
          "d": 0,
          "h": 0,
          "i": 4,
          "s": 52,
          "total_seconds": 292
          },
          "stay_in_pipeline_stages": {
          "times_in_stages": {
          "15": 291,
          "63": 0
          },
          "order_of_stages": [
          15,
          63
          ]
          },
          "last_activity": null,
          "next_activity": null
          },
          "additional_data": {
          "dropbox_email": "traffic+deal10375@pipedrivemail.com"
          },
          "related_objects": {
          "user": {
          "1623105": {
          "id": 1623105,
          "name": "Master Franchisor",
          "email": "chrisc@traffic.net.nz",
          "has_pic": false,
          "pic_hash": null,
          "active_flag": true
          }
          },
          "person": {
          "12702": {
          "id": 12702,
          "name": "Nick Chou",
          "email": [
          {
          "label": "",
          "value": "nickchou131@gmail.com",
          "primary": true
          }
          ],
          "phone": [
          {
          "label": "",
          "value": "0273250942",
          "primary": true
          }
          ]
          }
          }
          }
          }
          */
    }

}

?>
