<?php

namespace App\Controllers;

use App\Core\Authorization;
use App\Models\Offer;
use App\Models\Reason;
use App\Models\Report;

class ReportController extends Authorization
{
    public function __construct()
    {
        parent::__construct();
        $this->authRequired();
    }

    public function index(): void
    {
        $this->withPermission("MANAGE_OFFERS");
    }

    public function create(
        string $offerSlug = null,
        string $reasonSlug = null
    ): void {
        $offer = new Offer();
        $reason = new Reason();
        $report = new Report();

        if (
            empty($offerSlug)
            || ! $offerId = $offer->getId("slug", $offerSlug)
        ) {
            die(json_encode(["error" => "A oferta especificada é inválida."]));
        }

        if (
            empty($reasonSlug)
            || ! $reasonId = $reason->getId("slug", $reasonSlug)
        ) {
            die(json_encode(["error" => "O motivo do report é inválido."]));
        }

        if ($report->offerAlreadyReportedByUser($offerId)) {
            die(
                json_encode(
                    [
                        "error" => "Você já reportou esta oferta. 
                        Aguarde a análise da nossa equipe de administração."
                    ]
                )
            );
        }

        if ($report->create($offerId, $reasonId)) {
            die(json_encode([]));
        }

        die(
            json_encode(
                ["error" => "Não foi possível criar um report."]
            )
        );
    }
}