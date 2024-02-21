<?php
include_once("db.php");

class user extends DB
{
    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $userId;

    protected $search;

    /**
     * @param string $username
     * @param string $userId
     */
    public function __construct($username, $userId)
    {
        $this->username = $username;
        $this->userId = $userId;
    }

    /**
     * @return array|null
     */
    public function get_courses()
    {
        $query = "SELECT * FROM courses c, section s WHERE c.course_id = s.course_id and s.capacity > 0";
        $this->start_connection();
        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            $courses = array();
            while ($row = $result->fetch_assoc()) {
                array_push($courses, $row);
            }

            return $courses;
        } else {
            return NULL;
        }
    }

    /**
     * @return string
     */
    public function get_username()
    {
        return $this->username;
    }

    public function get_courseSection($course)
    {
        $this->start_connection();

        $query = "SELECT * FROM courses c, section s WHERE s.course_id = '" . $course['course_id'] . "' and s.section_id = '" . $course['section_id'] . "'";
        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function search($string)
    {
        $this->start_connection();

        $query = "SELECT * FROM (SELECT c.course_id, s.section_id, CONCAT_WS(' ', c.course_id, s.section_id) AS course FROM courses c, section s WHERE c.course_id = s.course_id) AS c WHERE course LIKE '%" . $string . "%'";

        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            $courses = array();

            while ($row = $result->fetch_assoc()) {
                $course = $this->get_courseSection($row);

                if ($course != null) {
                    array_push($courses, $course);
                }
            }

            return $courses;
        } else {
            return null;
        }
    }

    public function get_search()
    {
        return $this->search;
    }
}

class student extends user
{
    public function get_enrollCourses()
    {
        $query = "SELECT * FROM enrollment WHERE student_id = '" . $this->userId . "'";
        $this->start_connection();
        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            $courses = array();
            while ($row = $result->fetch_assoc()) {
                array_push($courses, $row);
            }

            return $courses;
        } else {
            return NULL;
        }
    }

    public function check_enrollStatus()
    {
        $this->start_connection();

        $query = "SELECT enroll_status FROM student WHERE student_id = " . $this->userId . "";

        $result = $this->run_query($query);

        return $result->fetch_assoc();
    }

    public function check_enroll()
    {
        $this->start_connection();

        $query = "SELECT * FROM enrollment WHERE enroll_status = 0 and student_id = " . $this->userId . "";

        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @param array $course;
     */
    public function enroll_course($course)
    {
        $query = 'INSERT INTO enrollment (student_id, course_id, section_id, credits, status) VALUES("' . $this->userId . '", "' . $course['course_id'] . '", "' . $course['section_id'] . '", "' . $course['credits'] . '", 0)';
        $this->start_connection();
        $this->run_query($query);
    }

    public function check_course($id)
    {
        $this->start_connection();

        $query = "SELECT * FROM enrollment WHERE course_id = '" . $id . "' and student_id = " . $this->userId . "";

        $result = $this->run_query($query);

        if ($result->num_rows == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function enroll()
    {
        $this->start_connection();

        $query = "UPDATE enrollment SET status = 1 WHERE status = 0";

        $this->run_query($query);
    }
}

class admin extends user
{

    public function __construct($username, $userId)
    {
        $this->username = $username;
        $this->userId = $userId;
    }

    public function add_course($course)
    {
        $this->start_connection();

        $query = "INSERT INTO courses (course_id, title, credits) VALUES('" . $course['id'] . "', '" . $course['title'] . "', " . $course['credits'] . ")";

        $this->run_query($query);
    }

    public function add_section($section)
    {
        $this->start_connection();

        $query = "INSERT INTO section (course_id, section_id, capacity, total_capacity) VALUES ('" . $section['course_id'] . "', '" . $section['section_id'] . "', " . $section['capacity'] . ", " . $section['capacity'] . ")";

        $this->run_query($query);
    }

    public function get_coursesID()
    {
        $this->start_connection();

        $query = "SELECT course_id FROM courses";

        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            $courses = array();

            while ($row = $result->fetch_assoc()) {
                array_push($courses, $row['course_id']);
            }

            return $courses;
        } else {
            return null;
        }
    }

    public function get_courses()
    {
        $query = "SELECT * FROM courses c";
        $this->start_connection();
        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            $courses = array();
            while ($row = $result->fetch_assoc()) {
                array_push($courses, $row);
            }

            return $courses;
        } else {
            return NULL;
        }
    }

    public function get_courses_and_sections()
    {
        $query = "SELECT * FROM courses c, section s WHERE c.course_id = s.course_id ORDER BY c.course_id";
        $this->start_connection();
        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            $courses = array();
            while ($row = $result->fetch_assoc()) {
                array_push($courses, $row);
            }

            return $courses;
        } else {
            return NULL;
        }
    }

    public function get_enroll($status)
    {
        $this->start_connection();

        $query = "SELECT * FROM enrollment WHERE status = " . $status . "";

        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            $courses = array();
            while ($row = $result->fetch_assoc()) {
                array_push($courses, $row);
            }

            return $courses;
        } else {
            return null;
        }
    }

    public function enroll()
    {
        $this->start_connection();

        $query = "UPDATE enrollment SET status = 2 WHERE status = 1";

        $this->run_query($query);
    }

    public function close_enroll()
    {
        $this->start_connection();

        $query = "UPDATE student SET enroll_status = 0 WHERE year_of_study > 0";

        $this->run_query($query);
    }

    public function get_course($id)
    {
        $this->start_connection();

        $query = "SELECT * FROM courses WHERE course_id = '" . $id . "'";
        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function get_sections($course_id)
    {
        $this->start_connection();

        $query = "SELECT * FROM section WHERE course_id = '" . $course_id . "'";

        $result = $this->run_query($query);
        if ($result->num_rows > 0) {
            $sections = array();

            while ($row = $result->fetch_assoc()) {
                array_push($sections, $row);
            }

            return $sections;
        } else {
            return null;
        }
    }

    public function update_course($course)
    {
        $this->start_connection();

        $query = "UPDATE courses SET title = '" . $course['title'] . "', credits = " . $course['credits'] . " WHERE course_id = '" . $course['id'] . "'";
        $this->run_query($query);
    }

    public function delete_course($id)
    {
        $this->start_connection();

        $query = "DELETE FROM courses WHERE course_id = '" . $id . "'";

        $this->run_query($query);
    }

    public function delete_user($id)
    {
        $this->start_connection();

        $query = "DELETE FROM student WHERE student_id = " . $id . "";

        $this->run_query($query);
    }

    public function get_users()
    {
        $query = "SELECT * FROM student WHERE year_of_study > 0";
        $this->start_connection();
        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            $users = array();
            while ($row = $result->fetch_assoc()) {
                $course = $this->get_userCourses($row['student_id']);
                $data = array(
                    "user" => $row,
                    "course" => $course
                );
                array_push($users, $data);
            }
            return $users;
        } else {
            return null;
        }
    }

    public function get_user($id)
    {
        $this->start_connection();

        $query = "SELECT * FROM student WHERE student_id = " . $id . "";

        $result = $this->run_query($query);
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }

    public function update_user($user)
    {
        $this->start_connection();

        $query = "UPDATE student SET user_name = '" . $user['username'] . "', year_of_study = '" . $user['year'] . "' WHERE student_id = " . $user['id'] . "";

        $this->run_query($query);
    }

    public function add_user($user)
    {
        $password = password_hash("user", PASSWORD_DEFAULT);

        $this->start_connection();

        $query = "INSERT INTO student(student_id, user_name, password, year_of_study) VALUES ('" . $user['id'] . "', '" . $user['username'] . "', '" . $password . "', " . $user['year'] . ")";

        $this->run_query($query);
    }

    public function get_userCourses($userID)
    {
        $query = "SELECT * FROM enrollment WHERE student_id = '" . $userID . "'";
        $this->start_connection();
        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            $courses = array();
            while ($row = $result->fetch_assoc()) {
                array_push($courses, $row);
            }

            return $courses;
        } else {
            return NULL;
        }
    }
}
