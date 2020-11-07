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

        $report = new Report();

        $this->setDir("Report");
        $this->setTitle("Lista de reports | Humbleprice");
        $this->setDescription("Veja os reports de promoções criados pelos usuários para alertar possíveis problemas.");
        $this->setKeywords("ofertas, produtos, report, problem");

        $this->setData(
            "pendingReports",
            $report->getLastReports()
        );

        $this->renderLayout($this->getData());
    }

    public function create(
        string $offerSlug = null,
        string $reasonSlug = null
    ): void {
        $offer = new Offer();
        $reason = new Reason();
        $report = new Report();

        if (! $this->isAjax()) {
            $this->redirect(DIRPAGE);
        }

        if (
            empty($offerSlug)
            || ! $offerId = $offer->getId("slug", $offerSlug)
        ) {
            die(json_encode(["error" => "A oferta especificada é inválida."]));
        }

        $offerData = $offer->getInfo("id", $offerId, ["status"]);

        if ($offerData["status"] === "closed") {
            die(
                json_encode(
                    [
                        "error" => "Esta oferta já foi encerrada. 
                        Portanto, não é possível reportar um problema."
                    ]
                )
            );
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