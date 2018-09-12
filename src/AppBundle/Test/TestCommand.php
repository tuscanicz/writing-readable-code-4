<?php

declare(strict_types=1);

namespace AppBundle\Test;

use AppBundle\Date\PeriodEnum;
use AppBundle\Library\LibraryStatistics;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand extends Command
{
    private $libraryStatistics;

    public function __construct(
        LibraryStatistics $libraryStatistics
    ) {
        $this->libraryStatistics = $libraryStatistics;
        parent::__construct();
    }

    public function configure()
    {
        $this
            ->setName('book:calculate')
            ->setDescription('Calculate average of book pages per period.')
            ->setHelp('This is just temporary command');
    }

    public function execute(InputInterface $input, OutputInterface $output): void
    {
        $sixties = new PeriodEnum(PeriodEnum::PERIOD_SIXTIES);

        $average = $this->libraryStatistics->getAverageNumberOfPagesInPeriod($sixties);
        $output->writeln(
            sprintf('In <info>sixties</info> there were average <info>%f pages</info> in the books', $average)
        );
    }
}
