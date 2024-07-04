<?php
declare(strict_types=1);

namespace App\Command;

use Cake\Console\Arguments;
use Cake\Console\BaseCommand;
use Cake\Console\ConsoleIo;
use Cake\ORM\TableRegistry;

class ListCustomersCommand extends BaseCommand
{
    public function execute(Arguments $args, ConsoleIo $io)
    {
        $customersTable = TableRegistry::getTableLocator()->get('Customers');
        $customers = $customersTable->find('all');

        foreach ($customers as $customer) {
            $io->out('患者番号: ' . $customer->customer_no . ', 患者名: ' . $customer->name . ', 性別: ' . $customer->sex . ', 生年月日: ' . $customer->birthdate . ', 電話番号: ' . $customer->telephone . ', 住所: ' . $customer->address . ', 状態: ' . $customer->status);
        }
    }
}
