# 📚 Estudos de Design Patterns em PHP

Este repositório reúne estudos práticos e aprofundados sobre **Design
Patterns aplicados em PHP**, com foco em arquitetura limpa, boas
práticas e organização modular.\
Aqui você encontrará exemplos reais, estruturados e comentados de
diferentes padrões utilizados em aplicações modernas.

O objetivo do projeto é servir como um **laboratório de aprendizado**,
concentrando:

-   Implementações individuais de cada pattern\
-   Exemplos práticos em código\
-   Comparação entre padrões semelhantes\
-   Demonstração de como se comportam em cenários reais\
-   Documentação clara e orientada para estudo

------------------------------------------------------------------------

## 🧩 Design Patterns Implementados

### **1. DTO (Data Transfer Object)**

Objetos simples utilizados exclusivamente para **transporte de dados
entre camadas** da aplicação.\
Não possuem lógica de domínio, apenas propriedades tipadas e,
opcionalmente, métodos auxiliares de leitura.

------------------------------------------------------------------------

### **2. Repository**

Encapsula a lógica de **persistência de aggregates** (entities + value
objects relacionados), isolando a camada de domínio dos detalhes de
armazenamento.\
Permite trocar o mecanismo de persistência (DB, API, cache, etc.) sem
afetar o restante da aplicação.

------------------------------------------------------------------------

### **3. Adapter**

Fornece uma interface que o cliente espera, permitindo que **classes
incompatíveis trabalhem juntas**.\
Resolve problemas de integração entre contratos diferentes sem alterar o
código original.

------------------------------------------------------------------------

### **4. Strategy**

Define uma **família de algoritmos intercambiáveis**, permitindo variar
comportamentos em tempo de execução.\
Favorece extensibilidade e elimina condicionais complexas.

------------------------------------------------------------------------

### **5. Presenter**

Responsável por **formatar e estruturar dados** para que fiquem
adequados ao consumo pelo cliente (API, frontend, terceiros, etc.).\
Muito útil para manter a camada de domínio livre de preocupações de
apresentação.

------------------------------------------------------------------------

### **6. Decorator**

O padrão Decorator permite estender o comportamento de um objeto dinamicamente, sem alterar sua estrutura original.
Ele envolve o objeto real com um wrapper que adiciona novas responsabilidades, mantendo a mesma interface.

------------------------------------------------------------------------

### **7. Controller**

Responsável por intermediar a comunicação entre camadas, atuando como um driver que:
- Recebe dados de entrada (HTTP, CLI, fila, evento etc.)
- Converte esses dados para um formato adequado ao caso de uso 
- Invoca a lógica de aplicação ou domínio 
- Retorna a resposta apropriada ao cliente (driver)

------------------------------------------------------------------------

### **7. Mediator**

Centraliza a comunicação entre objetos, reduzindo o acoplamento direto entre eles.
Em vez de um objeto conhecer e chamar diretamente vários outros, ele interage apenas com um mediador, que coordena quem deve ser notificado e como reagir.

------------------------------------------------------------------------