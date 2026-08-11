<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /**
     * The table name.
     *
     * @var string
     */
    protected $table;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * CreateSettingsTable constructor.
     */
    public function __construct()
    {
        $this->connection = config('settings.drivers.database.options.connection');
        $this->table      = config('settings.drivers.database.options.table', 'settings');
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * {@inheritdoc}
     */
    public function up(): void
    {
        Schema::create($this->table, function (Blueprint $table): void {
            $table->unsignedBigInteger('user_id')->default(0);
            $table->string('key');
            $table->text('value');
            $table->timestamps();

            $table->unique(['user_id', 'key']);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function down(): void
    {
        Schema::dropIfExists($this->table);
    }
};
