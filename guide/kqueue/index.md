# About KQueue

KQueue provides an abstract interface to message based queue systems. These can be used for background workers, notification queues etc. By default KQueue provides support for beanstalkd.


# Example Usage

To put Jobs into a queue:

    $queue = Queue::producer('my_tube');
    for($i = 100; $i <= 120; $i++) {
        $job = Queue_Job::factory("Job #$i");
        $queue->add($job);
        Minion_CLI::write("Added job #$i");
    }

To get Jobs out of a queue:

    $queue = Queue::consumer('my_tube');
    while($job = $queue->consume()) {
        Minion_CLI::write($job->get_data());
        $queue->delete($job);
    }
