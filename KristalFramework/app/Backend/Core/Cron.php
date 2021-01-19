<?php namespace Backend\Core;
defined("ACCESS") or exit("Access Denied");


class Cron
{
    private $name;
    private $task;
    private $interval;
    private $run_time;


    public function __construct($name, $task, $interval, $run_time = null, $start_date = null)
    {
        if (is_array($interval))
        {
            $this->interval = array(
                "amount" => $interval[0],
                "type" => $interval[1]
            );
        }
        else
        {
            switch (strtolower($interval))
            {
                case "daily": $this->interval = array("type" => "day", "amount" => 1); break;
                case "weekly": $this->interval = array("type" => "week", "amount" => 1); break;
                case "monthly": $this->interval = array("type" => "month", "amount" => 1); break;
                case "yearly": $this->interval = array("type" => "year", "amount" => 1); break;
                default: createError(["invalid interval for cron job: $name", "Value given was $interval"]); break;
            }
        }

        $this->name = $name;
        $this->task = $task;
        $this->run_time = isset($run_time) ? $run_time : "H:i:s";

        // Do not run cron job if activation date has not been reached
        if (isset($start_date) && strtotime(date('Y-m-d H:i:s')) < strtotime($start_date))
        {
            return;
        }

        if ($this->readyToExecute())
        {
            $this->updateTaskTimer();
            $this->executeTask();
        }
    }


    private function executeTask()
    {
        include($this->task);
    }


    private function readyToExecute()
    {
        $file = $this->getTaskLocation();

        if (file_exists($file))
        {
            $value = include $file;

            if ($value === null)
            {
                return true;
            }

            return strtotime(date('Y-m-d H:i:s')) > strtotime($value);
        }
        else
        {
            return true;
        }
    }


    private function updateTaskTimer()
    {
        $nextRunDate = date("Y-m-d {$this->run_time}", strtotime(date("Y-m-d {$this->run_time}") . "+{$this->interval['amount']} {$this->interval['type']}"));

        $content =  "<?php\n\n" .
        "// Last run at: " . date('Y-m-d H:i:s') . "\n" .
        "// Next run at: $nextRunDate" . "\n\n" .
        "return '$nextRunDate';";

        file_put_contents($this->getTaskLocation(), $content);
    }


    private function getTaskLocation()
    {
        return "cron/logs/" . getCleanName($this->name) . ".php";
    }
}