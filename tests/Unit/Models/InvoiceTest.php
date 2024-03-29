<?php

namespace Tests\Unit\Models;

use App\Models\Invoice;
use App\Models\InvoiceLine;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_user()
    {
        $user = User::factory()->create();
        $invoice = Invoice::factory()->create(['user_id' => $user->id]);

        $this->assertInstanceOf(User::class, $invoice->user);
    }

    /** @test */
    public function it_has_many_invoice_lines()
    {
        $invoice = Invoice::factory()->create();
        $invoiceLine = InvoiceLine::factory()->create(['invoice_id' => $invoice->id]);

        $this->assertInstanceOf(InvoiceLine::class, $invoice->invoiceLines->first());
    }

    /** @test */
    public function it_can_determine_if_it_is_paid()
    {
        $invoice = Invoice::factory()->create(['paid_amount' => 100, 'price' => 100]);

        $this->assertTrue($invoice->is_paid);
    }

    /** @test */
    public function it_can_scope_to_non_editable_invoices()
    {
        $editableInvoice = Invoice::factory()->create(['is_editable' => true]);
        $nonEditableInvoice = Invoice::factory()->create(['is_editable' => false]);

        $nonEditableInvoices = Invoice::nonEditable()->get();

        $this->assertTrue($nonEditableInvoices->contains($nonEditableInvoice));
        $this->assertFalse($nonEditableInvoices->contains($editableInvoice));
    }

    /** @test */
    public function it_can_scope_to_editable_invoices()
    {
        $editableInvoice = Invoice::factory()->create(['is_editable' => true]);
        $nonEditableInvoice = Invoice::factory()->create(['is_editable' => false]);

        $editableInvoices = Invoice::editable()->get();

        $this->assertTrue($editableInvoices->contains($editableInvoice));
        $this->assertFalse($editableInvoices->contains($nonEditableInvoice));
    }
}