<?php
include_once("db.php");

class user extends DB
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $userId;

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

    public function get_enrollCourse($course)
    {
        $query = "SELECT * FROM enrollment WHERE student_id = '" . $this->userId . "' and course_id = '" . $course['course_id'] . "' and section_id = '" . $course['section_id'] . "'";
        $this->start_connection();
        $result = $this->run_query($query);

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return string
     */
    public function get_username()
    {
        return $this->username;
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
}
