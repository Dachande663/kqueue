# KQueue

KQueue is a Message Queue module for Kohana 3.2. It provides abstract support for multiple drivers, though currently only comes bundled with support for the beanstalkd library.

## Examples

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
