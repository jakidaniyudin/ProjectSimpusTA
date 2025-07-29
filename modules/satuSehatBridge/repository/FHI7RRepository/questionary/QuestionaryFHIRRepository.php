<?php

require_once(APPPATH . 'modules/satuSehatBridge/interface/FHI7R/questionary/interfaceFHI7RQuestionnaire.php');
class QuestionaryFHIRRepository implements interfaceFHI7RQuestionnaire
{
    protected array $data = [];
    protected array $currentItem = [];

    public function __construct()
    {
        $this->reset();
    }

    public function reset(): self
    {
        $this->data = [
            'resourceType' => 'QuestionnaireResponse',
            'item' => []
        ];
        $this->currentItem = [];
        return $this;
    }

    public function setQuestionnaire(string $url): self
    {
        $this->data['questionnaire'] = $url;
        return $this;
    }

    public function setStatus(string $status): self
    {
        $this->data['status'] = $status;
        return $this;
    }

    public function setSubject(string $patientId, string $name): self
    {
        $this->data['subject'] = [
            'reference' => 'Patient/' . $patientId,
            'display' => $name
        ];
        return $this;
    }

    public function setEncounter(string $encounterUuid): self
    {
        $this->data['encounter'] = [
            'reference' => "Encounter/{$encounterUuid}"
        ];
        return $this;
    }

    public function setAuthored(string $datetime): self
    {
        $this->data['authored'] = $datetime;
        return $this;
    }

    public function setAuthor(string $reference): self
    {
        $this->data['author'] = [
            'reference' => 'Practitioner/' . $reference
        ];
        return $this;
    }

    public function setSource(string $reference): self
    {
        $this->data['source'] = [
            'reference' => 'Patient/' . $reference
        ];
        return $this;
    }

    public function startItem(string $linkId, string $text): self
    {
        $this->currentItem = [
            'linkId' => $linkId,
            'text' => $text,
            'item' => []
        ];
        return $this;
    }

    public function addSubItem(string $linkId, string $text, bool $valueBoolean): self
    {
        $this->currentItem['item'][] = [
            'linkId' => $linkId,
            'text' => $text,
            'answer' => [
                ['valueBoolean' => $valueBoolean]
            ]
        ];
        return $this;
    }

    public function commitItem(): self
    {
        if (!empty($this->currentItem)) {
            $this->data['item'][] = $this->currentItem;
            $this->currentItem = [];
        }
        return $this;
    }

    // untuk jawaban yang tidak mengandung sub item
    public function addItem($linkId, $text, $answers)
    {
        $this->data['item'][] = [
            'linkId' => $linkId,
            'text' => $text,
            'answer' => $answers
        ];
        return $this;
    }

    public function build(): array
    {
        return $this->data;
    }

    public function validate(): void
    {
        if (empty($this->data['questionnaire']) || empty($this->data['subject'])) {
            throw new Exception("Questionnaire and subject are required.");
        }
    }
}