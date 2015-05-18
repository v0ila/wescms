<?php

namespace Pagekit\Framework\Console;

use Pagekit\Framework\Console\Event\ConsoleEvent;
use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\Console\Command\Command as BaseCommand;
use Pagekit\Framework\Application as Container;

class Application extends BaseApplication
{
    /**
     * The Pagekit application instance.
     *
     * @var Container
     */
    protected $pagekit;

    /**
     * Constructor.
     *
     * @param Container $pagekit
     * @param string    $name
     */
    public function __construct(Container $pagekit, $name = null)
    {
        parent::__construct($name ?: 'Pagekit', $pagekit['config']['app.version']);

        $this->pagekit = $pagekit;

        if (isset($pagekit['events'])) {
            $pagekit['events']->dispatch('console.init', new ConsoleEvent($this));
        }
    }

    /**
     * Add a command to the console.
     *
     * @param  BaseCommand $command
     * @return BaseCommand
     */
    public function add(BaseCommand $command)
    {
        if ($command instanceof Command) {
            $command->setPagekit($this->pagekit);
        }

        return parent::add($command);
    }
}
