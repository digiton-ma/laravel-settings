<?php

declare(strict_types=1);

namespace Digitonma\LaravelSettings\Middleware;

use Digitonma\LaravelSettings\Contracts\Store;
use Closure;

/**
 * Class     SaveSettings
 *
 * @author   digiton-ma <contact@digiton.ma>
 */
class SaveSettings
{
    /* -----------------------------------------------------------------
     |  Properties
     | -----------------------------------------------------------------
     */

    /** @var  \Digitonma\LaravelSettings\Contracts\Store */
    protected $settings;

    /* -----------------------------------------------------------------
     |  Constructor
     | -----------------------------------------------------------------
     */

    /**
     * SaveSettings constructor.
     *
     * @param  \Digitonma\LaravelSettings\Contracts\Store  $settings
     */
    public function __construct(Store $settings)
    {
        $this->settings = $settings;
    }

    /* -----------------------------------------------------------------
     |  Main Methods
     | -----------------------------------------------------------------
     */

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Closure                   $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        return $next($request);
    }

    /**
     * Hasta la vista, baby.
     *
     * @param  \Illuminate\Http\Request                    $request
     * @param  \Symfony\Component\HttpFoundation\Response  $response
     */
    public function terminate($request, $response)
    {
        $this->settings->save();
    }
}
