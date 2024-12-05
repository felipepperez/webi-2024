<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\FinanceManager;

class FinanceManagerTest extends TestCase
{
    public function testAddTransaction()
    {
        $financeManager = new FinanceManager();

        $financeManager->addTransaction('in', 100.50);
        $financeManager->addTransaction('out', 50.25);

        $this->assertCount(2, $financeManager->getTransactions());
    }

    public function testGetBalance()
    {
        $financeManager = new FinanceManager();

        $financeManager->addTransaction('in', 200.00);
        $financeManager->addTransaction('out', 75.50);

        $this->assertEquals(124.50, $financeManager->getBalance());
    }

    public function testListTransactionsByType()
    {
        $financeManager = new FinanceManager();

        $financeManager->addTransaction('in', 150.00);
        $financeManager->addTransaction('out', 40.00);
        $financeManager->addTransaction('in', 60.00);

        $entradas = $financeManager->getTransactionsByType('in');
        $saidas = $financeManager->getTransactionsByType('out');

        $this->assertCount(2, $entradas);
        $this->assertCount(1, $saidas);

        $this->assertEquals(150.00, $entradas[0]['amount']);
        $this->assertEquals(60.00, $entradas[2]['amount']);
        $this->assertEquals(40.00, $saidas[1]['amount']);
    }
}