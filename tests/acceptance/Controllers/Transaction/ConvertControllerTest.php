<?php
/**
 * ConvertControllerTest.php
 * Copyright (C) 2016 thegrumpydictator@gmail.com
 *
 * This software may be modified and distributed under the terms of the
 * Creative Commons Attribution-ShareAlike 4.0 International License.
 *
 * See the LICENSE file for details.
 */

namespace Transaction;

use FireflyIII\Models\TransactionJournal;
use TestCase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-12-10 at 05:51:43.
 */
class ConvertControllerTest extends TestCase
{


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\ConvertController::index
     */
    public function testIndexDepositTransfer()
    {
        $deposit = TransactionJournal::where('transaction_type_id', 2)->where('user_id', $this->user()->id)->first();

        $this->be($this->user());
        $this->call('get', route('transactions.convert.index', ['transfer', $deposit->id]));
        $this->assertResponseStatus(200);
        $this->see('Convert a deposit into a transfer');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\ConvertController::index
     */
    public function testIndexDepositWithdrawal()
    {
        $deposit = TransactionJournal::where('transaction_type_id', 2)->where('user_id', $this->user()->id)->first();
        $this->be($this->user());
        $this->call('get', route('transactions.convert.index', ['withdrawal', $deposit->id]));
        $this->assertResponseStatus(200);
        $this->see('Convert a deposit into a withdrawal');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\ConvertController::index
     */
    public function testIndexTransferDeposit()
    {
        $transfer = TransactionJournal::where('transaction_type_id', 3)->where('user_id', $this->user()->id)->first();
        $this->be($this->user());
        $this->call('get', route('transactions.convert.index', ['deposit', $transfer->id]));
        $this->assertResponseStatus(200);
        $this->see('Convert a transfer into a deposit');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\ConvertController::index
     */
    public function testIndexTransferWithdrawal()
    {
        $transfer = TransactionJournal::where('transaction_type_id', 3)->where('user_id', $this->user()->id)->first();
        $this->be($this->user());
        $this->call('get', route('transactions.convert.index', ['withdrawal', $transfer->id]));
        $this->assertResponseStatus(200);
        $this->see('Convert a transfer into a withdrawal');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\ConvertController::index
     */
    public function testIndexWithdrawalDeposit()
    {
        $withdrawal= TransactionJournal::where('transaction_type_id', 1)->where('user_id', $this->user()->id)->first();
        $this->be($this->user());
        $this->call('get', route('transactions.convert.index', ['deposit', $withdrawal->id]));
        $this->assertResponseStatus(200);
        $this->see('Convert a withdrawal into a deposit');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\ConvertController::index
     */
    public function testIndexWithdrawalTransfer()
    {
        $withdrawal= TransactionJournal::where('transaction_type_id', 1)->where('user_id', $this->user()->id)->first();
        $this->be($this->user());
        $this->call('get', route('transactions.convert.index', ['transfer', $withdrawal->id]));
        $this->assertResponseStatus(200);
        $this->see('Convert a withdrawal into a transfer');
    }

    /**
     * @covers \FireflyIII\Http\Controllers\Transaction\ConvertController::postIndex
     */
    public function testPostIndex()
    {
        $withdrawal= TransactionJournal::where('transaction_type_id', 1)->where('user_id', $this->user()->id)->first();
        // convert a withdrawal to a transfer. Requires the ID of another asset account.
        $data = [
            'destination_account_asset' => 2,
        ];
        $this->be($this->user());
        $this->call('post', route('transactions.convert.index', ['transfer', $withdrawal->id]), $data);
        $this->assertResponseStatus(302);
        $this->assertRedirectedToRoute('transactions.show', [$withdrawal->id]);
    }
}
