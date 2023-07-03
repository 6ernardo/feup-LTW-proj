const filterTickets = document.querySelector('#submit_ticket_filter')
if (filterTickets) {
    filterTickets.addEventListener('click', async function() {
        const dept = document.getElementById('department').value;
        const status = document.getElementById('status').value;

        const response = await fetch('../api/api_filter_tickets.php?department=' + dept + '&status=' + status);
        const tickets = await response.json();

        const section = document.querySelector('#tickets');
        section.innerHTML = '';

        for(const ticket of tickets){
            const ul = document.createElement('ul');
            const link = document.createElement('a');
            link.href = '../pages/ticket.php?id=' + ticket.id;
            const subject = document.createElement('li');
            subject.textContent = ticket.subject;
            const department = document.createElement('li');
            department.textContent = ticket.department_id;
            const status = document.createElement('li');
            status.textContent = ticket.status_id;

            ul.appendChild(subject);
            ul.appendChild(department);
            ul.appendChild(status);

            section.appendChild(ul);
        }
    } )
}