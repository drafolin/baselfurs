export type Event = {
  dateFrom: Date
  dateTo?: Date
  name: string
  link?: string
  featured?: boolean
}

export const fetchNext = (max?: number): Event[] => {
  const defMax = max ?? 3

  return [
    {
      dateFrom: new Date('2024-04-13T17:00'),
      dateTo: new Date('2024-04-13T22:00'),
      name: 'Basler Stammtisch – April',
      featured: true
    },

    {
      dateFrom: new Date('2024-05-13T17:00'),
      dateTo: new Date('2024-05-13T22:00'),
      name: 'Basler Stammtisch – Mai'
    },

    {
      dateFrom: new Date('2024-06-13T17:00'),
      dateTo: new Date('2024-06-13T22:00'),
      name: 'Basler Stammtisch – June',
      featured: true
    },
    {
      dateFrom: new Date('2024-04-13T17:00'),
      dateTo: new Date('2024-04-13T22:00'),
      name: 'Basler Stammtisch – April',
      featured: true
    },
    {
      dateFrom: new Date('2024-04-13T17:00'),
      dateTo: new Date('2024-04-13T22:00'),
      name: 'Basler Stammtisch – April',
      featured: true
    }
  ].slice(0, defMax)
}

export const fetchOn = (d: Date): Event[] => {
  const yesterday = new Date(d);
  yesterday.setDate(yesterday.getDate() - 1)


  const tomorrow = new Date(d);
  tomorrow.setDate(tomorrow.getDate() + 1)

  const day = new Date(d);

  return [
    {
      dateFrom: day,
      dateTo: day,
      name: 'Basler Stammtisch – April',
      featured: true
    },
    {
      dateFrom: day,
      dateTo: day,
      name: 'Basler Stammtisch – Mai'
    },

    {
      dateFrom: yesterday,
      dateTo: day,
      name: 'Basler Stammtisch',
      featured: true
    },
    {
      dateFrom: yesterday,
      dateTo: tomorrow,
      name: 'Basler Stammtisch',
      featured: true
    },
    {
      dateFrom: day,
      dateTo: tomorrow,
      name: 'Basler Stammtisch',
      featured: true
    }
  ]
}
