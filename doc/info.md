Hexagonal Architecture Workshop 21.04.2015/bz


Codebase
https://github.com/matthiasnoback/high-quality-bundles-project
SimpleBus

Architecture
- Modular
- Strong Foundation
- Exchangeability
- Maintainability
- Codefixing one place
- Consitency
- Layers (View, Domain-(Business), Application)


Command Object -> Command Bus
- Contains action data
- Task
- data come from user most
- only one action


Events -> Event Bus
- Could call several actions




Boundaries
- Forms (in core are no forms)


Validation
- maybe Domain Service over all


Randnotizen:
- UUID for ID for not wait of auto generatet ID from database
- In Events nur die wirklich benoetigten Daten uebergeben / diese nach aussen gegeben

Fragen:
- SimpleBus for production?
- UUID Performane Issues on mysql?

