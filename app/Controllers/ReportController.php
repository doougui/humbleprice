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
    }

    public function index(): void
    {
        $this->authRequired()->withPermission("MANAGE_OFFERS");

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

        if (! $this->authenticated()) {
            die(
                json_encode(
                    [
                        "error" => "Você precisa estar logado para 
                            realizar esta ação."
                    ]
                )
            );
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

    public function accept(int $id = null): void
    {
        $this->authRequired()->withPermission("MANAGE_OFFERS");

        if ($this->setStatus("accepted", $id)) {
            die(json_encode([]));
        }

        die(
            json_encode([
                "error" =>  "Não foi possível aceitar este report."
            ])
        );
    }

    public function refuse(int $id = null): void
    {
        $this->authRequired()->withPermission("MANAGE_OFFERS");

        if ($this->setStatus("refused", $id)) {
            die(json_encode([]));
        }

        die(
            json_encode([
                "error" =>  "Não foi possível recusar este report."
            ])
        );
    }

    private function setStatus(string $status, int $id = null): bool
    {
        $report = new Report();

        if (
            empty($id)
            || ! $reportId = $report->getId("id", $id)
        ) {
            die(
                json_encode([
                    "error" =>  "Este report é inválido."
                ])
            );
        }

        $reportData = $report->getInfo(
            "id",
            $id,
            ["id_reason", "id_offer"]
        );

        if (
            $report->updateStatus(
                $reportData["id_offer"],
                $reportData["id_reason"],
                $status
            )
        ) {
            return true;
        }

        die(
            json_encode([
                "error" =>  "Não foi possível alterar o status do report."
            ])
        );
    }
}