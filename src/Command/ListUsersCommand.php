<?php
/**
 * Created by PhpStorm.
 * User: KamilWi
 * Date: 23.03.2019
 * Time: 18:35
 */

namespace App\Command;

use App\Service\GenerateUserList;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Command\LockableTrait;
use Symfony\Component\Console\Helper\Table;

class ListUsersCommand extends Command implements CommandInterface
{
    use LockableTrait;

    /**
     * @var OutputInterface
     */
    protected $output;

    /**
     * @var GenerateUserList
     */
    private $generateUserListService;

    public function __construct(GenerateUserList $generateUserListService)
    {
        parent::__construct();
        $this->generateUserListService = $generateUserListService;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('random-user')
            ->setDescription(CommandInterface::RANDOM_USER_DESCRIPTION)
            ->setDefinition(
                new InputDefinition(
                    [
                        new InputOption('format-output', 'f', InputOption::VALUE_NONE, CommandInterface::RANDOM_USER_FORMAT_DESCRIPTION)
                    ]
                )
            );
    }

    /**
     * Print Output as Table
     * @param array $data
     */
    protected function outputTableData(array $data): void
    {
        $table = new Table($this->output);
        $table
            ->setHeaders(array('First Name', 'Last Name', 'Address'));
        $i = 0;
        foreach ($data as $row) {
            $table->setRow($i++, $row);
        }
        $table->render();
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->output = $output;
        if (!$this->lock()) {
            $this->output->writeln(CommandInterface::CONSOLE_COMMAND_LOCKED);
            return 0;
        }

        $consoleParams = $input->getOptions();

        $generateList = $this->generateUserListService;
        $data = $generateList(5);

        if ($consoleParams["format-output"]) {
            $this->outputTableData($data);
        } else {
            $output->writeln(json_encode($data));
        }

        $this->release();
    }
}