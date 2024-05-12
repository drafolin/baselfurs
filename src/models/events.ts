export type Event = {
  start: Date,
  end: Date,
  title: string
  url?: string
}

export const fetchNext = async (max?: number): Promise<Event[]> => {
  const defMax = max ?? 3

  return [
    {
      start: new Date('2024-04-13T17:00'),
      end: new Date('2024-04-13T22:00'),
      title: 'Basler Stammtisch – April',
    },

    {
      start: new Date('2024-05-13T17:00'),
      end: new Date('2024-05-13T22:00'),
      title: 'Basler Stammtisch – Mai',
    },

    {
      start: new Date('2024-06-13T17:00'),
      end: new Date('2024-06-13T22:00'),
      title: 'Basler Stammtisch – June',
    },
    {
      start: new Date('2024-04-13T17:00'),
      end: new Date('2024-04-13T22:00'),
      title: 'Basler Stammtisch – April',
    },
    {
      start: new Date('2024-04-13T17:00'),
      end: new Date('2024-04-13T22:00'),
      title: 'Basler Stammtisch – April',
    }
  ].slice(0, defMax)
}

export const fetchRange = async (period: { start: Date, end: Date }): Promise<Event[]> => {
  const ptr = new Date(period.start);
  ptr.setDate(period.start.getDate() + 3);
  const d3 = new Date(ptr);


  return [
    {
      start: period.start,
      end: period.start,
      title: 'Basler Stammtisch – April',
    },
    {
      start: period.start,
      end: d3,
      title: 'Basler Stammtisch – Mai',
    },

    {
      start: period.start,
      end: period.end,
      title: 'Basler Stammtisch',
    },
  ]
}
