<?php


require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/InterfaceResource.php');

interface interfaceFHI7RQuestionnaire extends InterfaceResource
{
    public function setQuestionnaire(string $url): self;
    public function setStatus(string $status): self;
    public function setSubject(string $reference, string $display): self;
    public function setEncounter(string $encounterUuid): self;
    public function setAuthored(string $datetime): self;
    public function setAuthor(string $reference): self;
    public function setSource(string $reference): self;
    public function startItem(string $linkId, string $text): self;
    public function addSubItem(string $linkId, string $text, bool $valueBoolean): self;
    public function commitItem(): self;
    public function addItem($linkId, $text, $answers);
}